<?php
    if (!defined('PATH_CONTROLLER')) die ('Bad requested!');
    if (!defined('DOMAIN')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '/Base_Controller.php';

    class URL_Controller extends Base_Controller {
        private $_infoLink;

        function __construct() {
            try{
                require_once PATH_MODEL . '/URL_Model.php';
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
// Nam
        function inputAction() {
            try {
                if (isset($_POST['link']) && $_POST['link'] !== '') {
                    $linkInput = $_POST['link'];
                    if ($this->validateURL($linkInput)) {
                        $existKey = $this->hadURLInDatabase($linkInput);
                        if($existKey){
                          // Sủa thêm đoạn code này vào hàm loadURLInfo
                            $data = $this->getLinkInfo($existKey);
                            if($data && strlen($data->original_link) > 64){
                                $data->original_link = substr($data->original_link,0,64) . '[...]';
                            }
                            $this->loadURLInfoToHomePage($data);
                        }
                        else{
                            $lastKey  = $this->model->findLastKeyURLTable();
                            $newId    = $this->computeIdURLByKey($lastKey) + 1;
                            $newKey   = $this->computeKeyByIdURL($newId);
                            $insertSuccess = $this->model->insertURLRecord($newKey,$linkInput);
                            if($insertSuccess){
                                $data = $this->getLinkInfo($newKey);
                                if($data && strlen($data->original_link) > 64){
                                    $data->original_link = substr($data->original_link,0,64) . '[...]';
                                }
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
            catch (PDOException $e){
                $this->goToMaintenancePage();
                exit();
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
//Loc
        function validateURL($url){
            $inputURLWithoutScriptTags = strip_tags($url); // Lọc những tags của javascript để tránh XSS attack
            if (filter_var($inputURLWithoutScriptTags,FILTER_VALIDATE_URL) && strlen($url) < 65234) {  // Kiểm tra xem input có phải URL không.
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
// Loc
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
