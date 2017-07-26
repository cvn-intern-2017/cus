<?php
    if (!defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '\Base_Model.php';
    //include_once 'Base_Model.php';

    class URL_Model extends Base_Model{

        public function __construct() {
            parent::__construct();
        }

        public function getURLInfoById($id){
            $this->setQuery("SELECT * FROM URL where id = ?");
            $result = $this->loadOneRecord(array($id));
            return $result;
        }

        function insertNewURLRecord($originalLink){
            $this->setQuery("INSERT INTO url (original_link) VALUES (?)");
            $result = $this->execute(array($originalLink));
            if ($result){
              return $this->getLastID();
            }
            else{
              return false;
            }
        }

        function findIdRecordOfURL($url){
            $this->setQuery("SELECT id FROM URL where original_link = ?");
            $result = $this->loadOneRecord(array($url));
            return $result;
        }

        function findLastKeyURLTable(){
            $this->setQuery("SELECT key_url FROM URL WHERE created_time = (SELECT MAX('created_time') AS 'max_created_time' FROM URL )");
            $result = $this->execute();
            return $result;
        }
        function insertRecordToURLTable($key,$originalLink){
            $this->setQuery("INSERT INTO url (key_url, original_link) VALUES (?,?)");
            $result = $this->execute(array($key,$originalLink));
            if ($result){
              return $this->findLastKeyURLTable();
            }
            else{
              return false;
            }

        }
   }

?>
