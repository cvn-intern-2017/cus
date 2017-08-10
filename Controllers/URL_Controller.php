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
                $linkInput = trim($_POST['link']); // Loại bỏ khoản trống trước và sau url.
                if(!$this->validateURL($linkInput)){
                    $data['error'] = 'Invalid URL';
                    $this->goToHomePage($data);
                    return;
                }
                // Tìm trong database URL link được input để lấy key.
                $idForLoadInfoLink = $this->hadURLInDatabase($linkInput);
                if(!$idForLoadInfoLink){
                    $newId = $this->addNewURLRecord($linkInput);
                    // Nếu không có key cũ để load thì lấy key mới tạo để load.
                    $idForLoadInfoLink = $newId;
                }
                $this->loadURLInfoToHomePage($idForLoadInfoLink);
            }
            catch(PDOException $e){
                $this->goToMaintenancePage();
                exit();
            }
        }

        function addNewURLRecord($linkInput){
            $result = $this->model->insertURLRecord($linkInput);
            $newId = $this->model->getLastId();
            return $newId;
        }

        function validateURL($url){
            $inputURLWithoutScriptTags = strip_tags($url); // Lọc những tags của javascript để tránh XSS attack
            if(filter_var($inputURLWithoutScriptTags,FILTER_VALIDATE_URL) && strlen($url) < MAX_URL_CHARS){  // Kiểm tra xem input có phải URL không.
                return true;
            }
            else{
                return false;
            }
        }

        function loadURLInfoToHomePage($id){
            $data = $this->model->findDataById($id);
            
            $data = json_encode($data);
            $this->loadView("home",$data);
        }

        function goToHomePage($data=array()){
            $this->loadView("home",json_encode($data));
        }

        function goToMaintenancePage(){
            $this->loadView("maintenance");
        }

        function hadURLInDatabase($originalURL){
            $id = $this->model->findIdRecordOfURL($originalURL);
            if($id){
                return $id;
            }
            else{
                return false;
            }
        }
    }
?>
