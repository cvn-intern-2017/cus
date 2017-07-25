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
                    $idURL = $this->getIdOfURL($_POST['link']);
                    if ($idURL) {
                        $data = $this->getLinkInfo($idURL);
                        $this->loadURLInfoToHomePage($data);
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
            $keyShortenedURL = $this->computeKeyByIdURL($idFromURL);
            $data['newLink'] = DOMAIN . $keyShortenedURL;
            $data['originalLink'] = $result->original_link;
            $data['originalLinkDisplayed'] = (strlen($result->original_link) > 52)?substr($result->original_link,0,52).' [...]' : $result->original_link;
            $data['analysticDataLink'] = DOMAIN . $keyShortenedURL . "+";
            return $data;
        }
        // Hàm return id của url được user input
        function getIdOfURL($url){
            // Kiểm tra xem key được tạo ra có bị trùng với key đã có trước đó chưa
            $idURL = $this->hadURLInDatabase($url);
            if($idURL) {
                return $idURL;
            }
            else {
                $lastIdOfURLRecord = $this->model->insertNewURLRecord($url);
                return $lastIdOfURLRecord;
            }
        }
        // get key from id of url, convert id (10-base) to key (62-base)
        function computeKeyByIdURL($id){
            return convert10BaseTo62Base($id);
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

        function loadURLInfoToHomePage($data) {
            $this->loadView("home",$data);
        }
        function goToHomePage(){
            $this->loadView("home");
        }
        function goToMaintenancePage(){
            $this->loadView("maintenance");
        }

        function hadURLInDatabase($originalURL){
            $record = $this->model->findIdRecordOfURL($originalURL);
            if ($record){
                return $record->id;
            }
            else {
                return false;
            }
        }
    }
?>
