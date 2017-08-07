<?php
    class URL_Model extends Base_Model{

        function __construct(){
            parent::__construct();
        }

        function findKeyRecordOfURL($url){
            $this->setQuery("SELECT key_url FROM url WHERE original_link = ?");
            $result = $this->loadOneRecord(array($url));
            if($result){
                return $result->key_url;
            }
            else{
                return false;
            }
        }

        function findLastKeyURLTable(){
            $this->setQuery('SELECT key_url FROM url WHERE created_time = (SELECT MAX(created_time) FROM url)');
            $result = $this->loadOneRecord();
            if($result){
                return $result->key_url;
            }
            else{
                return false;
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

        function findDataByKey($key){
            $this->setQuery("SELECT * FROM url WHERE key_url = ?");
            $result = $this->loadOneRecord(array($key));
            var_dump($result);
            return $result;
        }

   }

?>
