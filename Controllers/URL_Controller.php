<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    if ( ! defined('DOMAIN')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '\Base_Controller.php';
    class URL_Controller extends Base_Controller {
        private $_infoLink;
        function __construct() {
            require_once PATH_MODEL . '/URL_Model.php';
            $this->model = new URL_Model();
        }

        function indexAction() {
            $this->goToHomePage();
        }

        function inputAction() {
            if (isset($_POST['link']) && $_POST['link'] !== '') {
                if ($this->validateURL($_POST['link'])) {
                    $idURL = $this->addNewURLRecordToDatabase($_POST['link']);
                    if ($idURL) {
                        $data = $this->getLinkInfo($idURL);
                        $this->goToHomePage($data);
                    }
                    else {
                      $this->goToMaintenancePage();
                    }
                }
                else {
                    $this->goToHomePage();
                }
            }
            else {
                $this->goToHomePage();
            }
        }
        function getLinkInfo($idFromURL){
            $result = $this->model->getURLInfoById($idFromURL);
            $data['newLink'] = DOMAIN . $idFromURL; //
            $data['originalLink'] = $result->original_link;
            $data['originalLinkDisplayed'] = (strlen($result->original_link) > 52)?substr($result->original_link,0,52).'[...]' : $result->original_link;
            $data['analysticDataLink'] = DOMAIN . $keyFromURL . "+";
            return $data;
        }
        // Hàm trả về 1 chuổi random với mặc định là 6 kí tự.
        private function generateRandomString() {
            $characters = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
            return substr($characters,0,6);
        }

        function  hadKeyInDatabase ($key){
            if($this->model->getURLInfoByKey($key)){
                return false;
            }
            else{
              return true;
            }
        }
        function computeKeyByIdURL($id){
            return convert10BaseTo62Base($id);
        }
        function addNewURLRecordToDatabase($url){
            // Kiểm tra xem key được tạo ra có bị trùng với key đã có trước đó chưa
            do{
              $newKey = $this->generateRandomString();
            } while(!$this->hadKeyInDatabase($newKey));
            $insertSuccess = $this->model->insertNewURLRecord($newKey,$url);
            if ($insertSuccess){
              return $newKey;
            }
            else{
              return false;
            }
        }
        // Hàm kiểm tra URL được user input vào form.
        function validateURL($url){
            $inputURLWithoutScriptTags = strip_tags($url); // Lọc những tags của javascript để tránh XSS attack
            if (filter_var($inputURLWithoutScriptTags, FILTER_VALIDATE_URL)) {  // Kiểm tra xem input có phải URL không.
                return true;
            }
            else {
                return false;
            }
        }

        function goToHomePage($data=array()) {
            $this->loadView("home",$data);
        }
        function goToMaintenancePage(){
            $this->loadView("maintenance");
        }

        // kiểm tra url có trong database chưa
        function checkURLexist($url){
            $key = $this->model->checkURLexistDB($url);
            if ($key){
              // tạo key mới
            }
            else {
                return $key;
            }

        }



    }
?>
