<?php
    if (!defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '\Base_Model.php';
    //include_once 'Base_Model.php';

    class URL_Model extends Base_Model{

        public function __construct() {
            parent::__construct();
        }

        function findKeyRecordOfURL($url){
            $this->setQuery("SELECT key_url FROM URL where original_link = ?");
            $result = $this->loadOneRecord(array($url));
            return $result->key_url;
        }

        function findLastKeyURLTable(){
            $this->setQuery("SELECT key_url FROM URL WHERE created_time = (SELECT MAX(created_time) FROM URL )");
            $result = $this->loadOneRecord();
            return $result->key_url;
        }
        function insertURRecord($key,$originalLink){
            $this->setQuery("INSERT INTO url (key_url, original_link) VALUES (?,?)");
            $result = $this->execute(array($key,$originalLink));
            if ($result){
              return $this->findLastKeyURLTable();
            }
            else{
              return false;
            }

        }
        function findDataByKey($key){
            $this->setQuery("SELECT * FROM URL WHERE key_url = ?");
            $result = $this->loadOneRecord(array($key));
            return $result;
        }

   }

?>
