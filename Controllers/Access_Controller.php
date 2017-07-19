<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '\Base_Controller.php';
    class Access_Controller extends Base_Controller {
        function __construct() {
            require_once PATH_MODEL . '/Access_Model.php';
            $this->model = new Access_Model();
        }
        function indexAction() {

        }
        function validateURL($key){

        }

    }
?>
