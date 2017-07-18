<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    
    class URL_Controller extends Base_Controller {
        function __construct() {
            parent::__construct();
        }
        function indexAction() {
           $model = $this->model;
            
           $data['test_para'] = "OK" ;
           $this->loadView('test', $data);
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