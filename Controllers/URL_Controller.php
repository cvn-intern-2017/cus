<?php
    class URL_Controller extends Base_Controller{
        private $_infoLink;

        function __construct(){
            try{
                $this->model = new URL_Model();
            }
            catch (PDOException $e){
              $data =  substr($e->getMessage(),0,15);
              $this->goToMaintenancePage($data);
              exit();
            }
        }

        function indexAction() {
            $this->goToHomePage();
        }

        function inputAction() {
            try{
                if(!isset($_POST['link']) || !($_POST['link'] !== '')){
                    $data['error'] = 'Please Input Your URL';
                    $this->goToHomePage($data);
                    return;
                }
                $linkInput = trim($_POST['link']); // Remove whitespace before and after url
                if(!$this->validateURL($linkInput)){
                    $data['error'] = 'Invalid URL';
                    $this->goToHomePage($data);
                    return;
                }
                // Find key in database url
                $idForLoadInfoLink = $this->hadURLInDatabase($linkInput);
                if(!$idForLoadInfoLink){
                    $newId = $this->addNewURLRecord($linkInput);
                    // If the key does not exist then create a new key to load
                    $idForLoadInfoLink = $newId;
                }
                $this->loadURLInfoToHomePage($idForLoadInfoLink);
            }
            catch(PDOException $e){
                 $data =  substr($e->getMessage(),0,15);
                 $this->goToMaintenancePage($data);
                 exit();
            }
        }

        function addNewURLRecord($linkInput){
            $result = $this->model->insertURLRecord($linkInput);
            $newId = $this->model->getLastId();
            return $newId;
        }

        function validateURL($url){
            $inputURLWithoutScriptTags = strip_tags($url); // Filtering tags of javascript to avoid XSS attack
            if(filter_var($inputURLWithoutScriptTags,FILTER_VALIDATE_URL) && strlen($url) < MAX_URL_CHARS){  // Check if the input is a URL.
                return true;
            }
            else{
                return false;
            }
        }

        function loadURLInfoToHomePage($id){
            $data = $this->model->findDataById($id);

            $data = json_encode($data);
            $this->loadView(PAGE_HOME,$data);
        }

        function goToHomePage($data=array()){
            $this->loadView(PAGE_HOME,json_encode($data));
        }

        function goToMaintenancePage($data){
            $this->loadView(PAGE_MAINTENANCE,$data);
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
