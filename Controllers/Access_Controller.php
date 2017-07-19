<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '\Base_Controller.php';

    include_once 'Base_Controller.php';
    class Access_Controller extends Base_Controller {
        function __construct() {
            require_once PATH_MODEL . '/Access_Model.php';
            $this->model = new Access_Model();
        }
        function indexAction() {

        }
        function validateURL($key){


        }
        function redirectURL($key){
            // tìm trong database
            $url= $this->model->getURlbyKey($key);
            header("Location: ".$url);
            /* Make sure that code below does not get executed when we redirect. */
            exit;

        }
    }

?>
