<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '\Base_Controller.php';
    class URL_Controller extends Base_Controller {
        function __construct() {
            require_once PATH_MODEL . '/URL_Model.php';
            $this->model = new URL_Model();
        }
        function indexAction() {
            $this->loadHeader();
            $this->loadView('test');
            $this->loadFooter();
        }
        function inputAction() {
        }
        // Hàm trả về 1 chuổi random với mặc định là 6 kí tự.
        function generateRandomString($length = 6) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        function checkValidKey($key){

        }
    }
?>
