<?php
    class URL_Model extends Base_Model{

        function __construct(){
            parent::__construct();
        }

        function findIdRecordOfURL($url){
            $this->setQuery("SELECT id FROM url WHERE original_link = ?");
            $result = $this->loadOneRecord(array($url));
            if($result){
                return $result->id;
            }
            else{
                return null;
            }
        }

        function insertURLRecord($originalLink){
            $this->setQuery("INSERT INTO url (original_link) VALUES (?)");
            $result = $this->execute(array($originalLink));
            if($result){
              return true;
            }
            else{
              return false;
            }
        }

        function findDataById($id){
            $this->setQuery("SELECT * FROM url WHERE id = ?");
            $result = $this->loadOneRecord(array($id));
            return $result;
        }
   }

?>
