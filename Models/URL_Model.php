<?php
    if ( ! defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '\Base_Model.php'; 
    class URL_Model extends Base_Model{
        public function __construct() {
            parent::__construct();
        }
   }
    
?>