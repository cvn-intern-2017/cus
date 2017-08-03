<?php
    class URL_Controller extends Base_Controller{
        private $_infoLink;

        function __construct(){
            try{
                $this->model = new URL_Model();
            }
            catch (PDOException $e){
                $this->goToMaintenancePage();
                exit();
            }
        }

        function indexAction() {
            $this->goToHomePage();
        }

        function inputAction() {
            try{
                if(!isset($_POST['link']) || !($_POST['link'] !== '')){
                    $this->goToHomePage();
                    return;
                }
                $linkInput = trim($_POST['link']);
                if(!$this->validateURL($linkInput)){
                    $this->goToHomePage();
                    return;
                }
                // Tìm trong database URL link được input để lấy key.
                $keyForLoadInfoLink = $this->hadURLInDatabase($linkInput);
                if(!$keyForLoadInfoLink){
                    $newKey = $this->getNewKeyForNewRecordURL();
                    // nếu insert thất bại sẽ bị quăng exception try catch và hiện trang maintenance.
                    $insertSuccess = $this->addNewURLRecord($newKey,$linkInput);
                    // Nếu không có key cũ để load thì lấy key mới tạo để load.
                    $keyForLoadInfoLink = $newKey;
                }
                $this->loadURLInfoToHomePage($keyForLoadInfoLink);
            }
            catch(PDOException $e){
                $this->goToMaintenancePage();
                exit();
            }
        }

        function getNewKeyForNewRecordURL(){
            $lastKey  = $this->model->findLastKeyURLTable();
            $newId    = $this->computeIdURLByKey($lastKey) + 1;
            $newKey   = $this->computeKeyByIdURL($newId);
            return $newKey;
        }

        function addNewURLRecord($newKey,$linkInput){
            return $this->model->insertURLRecord($newKey,$linkInput);
        }

        // get key from id of url, convert id (10-base) to key (62-base)
        function computeKeyByIdURL($id){
            return convert10BaseTo62Base($id);
        }

        function computeIdURLByKey($key){
            return convert62BaseTo10Base($key);
        }

        function validateURL($url){
            $inputURLWithoutScriptTags = strip_tags($url); // Lọc những tags của javascript để tránh XSS attack
            if(filter_var($inputURLWithoutScriptTags,FILTER_VALIDATE_URL) && strlen($url) < 65234){  // Kiểm tra xem input có phải URL không.
                return true;
            }
            else{
                return false;
            }
        }

        function loadURLInfoToHomePage($key){
            $data = $this->model->findDataByKey($key);
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
            if($key){
                return $key;
            }
            else{
                return false;
            }
        }
    }
?>
