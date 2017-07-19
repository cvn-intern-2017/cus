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
            if (isset($_POST['link'])) {
                if ($this->validateURL($_POST['link'])) {
                    $this->addURL($_POST['link']);
                }
                else {
                    // Hiện pop up lỗi.
                }
            }
            else {
                // Hiện trang báo lỗi
            }
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
        function validateKey($key){
            if($this->model->hasKey($key)){
                return false;
            }
            else{
              return true;
            }
        }
        function addURL($url){
            // Kiểm tra xem key được tạo ra có bị trùng với key đã có trước đó chưa
            while(!$this->validateKey($key=$this->generateRandomString()));
            // add URL vào database
        }
        // Hàm kiểm tra URL được user input vào form.
        function validateURL($url){
            $input_url = strip_tags($url); // Lọc những tags của javascript để tránh XSS attack
            if (filter_var($url, FILTER_VALIDATE_URL)) {  // Kiểm tra xem input có phải URL không.
                return True;
            }
            else {
                return False;
            }
        }
    }
?>
