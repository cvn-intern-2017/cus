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
                $linkInput = $_POST['link'];
                if ($this->validateURL($linkInput)) {
                  $existKey = $this->hadURLInDatabase($linkInput);
                  if($existKey){

                      //exit('Trả về full shorten Link --> load giao diện');
                      $data = $this->getLinkInfo($existKey);
                      $this->loadURLInfoToHomePage($data);
                  }
                  else{ //link mới

                      $lastKey  = $this->model->findLastKeyURLTable();
                      $newId    = $this->computeIdURLByKey($lastKey) + 1;
                      $newKey   = $this->computeKeyByIdURL($newId);
                      $insertSuccess = $this->model->insertRecordToURLTable($newKey, $linkInput);
                      if($insertSuccess){
                          $data = $this->getLinkInfo($newKey);
                          $this->loadURLInfoToHomePage($data);
                      }
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
        function getLinkInfo($key){
            return $this->model->findDataByKey($key);
        }

        // get key from id of url, convert id (10-base) to key (62-base)
        function computeKeyByIdURL($id){
            return convert10BaseTo62Base($id);
        }
        function computeIdURLByKey($key){
            return convert62BaseTo10Base($key);
        }
        // From input form.
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
            $key = $this->model->findKeyRecordOfURL($originalURL);
            if ($key){
                return $key;
            }
            else {
                return false;
            }
        }
    }
?>
