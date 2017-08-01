<?php
    if(!defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '/Base_Model.php';
    //include_once 'Base_Model.php';

    class URL_Model extends Base_Model{

        function __construct(){
            parent::__construct();
        }
// Loc
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
// Hang
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
        function insertURLRecord($key,$originalLink){
            $this->setQuery("INSERT INTO url (key_url, original_link) VALUES (?,?)");
            $result = $this->execute(array($key,$originalLink));
            if($result){
              //return $this->findLastKeyURLTable();
              return true;
            }
            else{
              return false;
            }

        }
        function findDataByKey($key){
            $this->setQuery("SELECT * FROM url WHERE key_url = ?");
            $result = $this->loadOneRecord(array($key));
            return $result;
        }

   }

?>
