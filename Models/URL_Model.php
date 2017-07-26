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

<<<<<<< HEAD
        function insertNewURLRecord($key,$url_original){
          $this->setQuery("INSERT INTO url (original_link) VALUES (?)");
          $result = $this->execute(array($url_original));
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
        // function checkURLexistDB($url){
        //     $this->setQuery("SELECT * FROM URL where original_link = ?");
        //     $result = $this->loadOneRecord(array($url));
        //   if($result){
        //     return $result->id;
        //   }
        //   else {
        //     return false;
        //   }
        // }
=======
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
>>>>>>> 651bff5fe0142bac2492cf3968cf01751333b01b
   }

?>
