<?php
    if (!defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '\Base_Model.php';
    //include_once 'Base_Model.php';

    class URL_Model extends Base_Model{

        public function __construct() {
            parent::__construct();
        }
        // Hàm kiểm tra xem key được tạo có trong database chưa
        public function hasKey($key){
            $this->setQuery("SELECT * FROM URL where key_link = ?");
            $result = $this->loadRow(array($key));
            return $result;
        }

        function addNewKeyRecord($key,$url_original){
          $this->setQuery("INSERT INTO url (key_link, original_link) VALUES (?,?)");
          $result = $this->execute(array($key,$url_original));
          if ($result){
            return true;
          }
          else{
            return false;
          }
        }

   }

?>
