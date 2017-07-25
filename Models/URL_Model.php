<?php
    if (!defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '\Base_Model.php';
    //include_once 'Base_Model.php';

    class URL_Model extends Base_Model{

        public function __construct() {
            parent::__construct();
        }

        public function getURLInfoByKey($key){
            $this->setQuery("SELECT * FROM URL where key_link = ?");
            $result = $this->loadOneRecord(array($key));
            return $result;
        }

        function insertNewURLRecord($key,$url_original){
          $this->setQuery("INSERT INTO url (key_link, original_link) VALUES (?,?)");
          $result = $this->execute(array($key,$url_original));
          if ($result){
            return true;
          }
          else{
            return false;
          }
        }
        function checkURLexistDB($url){
          $this->setQuery("SELECT * FROM URL where original_link = ?");
          $result = $this->loadOneRecord(array($url));
          if($result){
            return $result->key_link;
          }
          else {
            return false;
          }
        }
   }

?>
