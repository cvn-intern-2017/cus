<?php
    if ( ! defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '\Base_Model.php'; 
    class Access_Model extends Base_Model{
        function __construct () {
            parent::__construct();
        }
   }
    
?>