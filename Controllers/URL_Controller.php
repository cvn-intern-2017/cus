<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    if ( ! defined('DOMAIN')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '\Base_Controller.php';
    class URL_Controller extends Base_Controller {
        function __construct() {
            require_once PATH_MODEL . '/URL_Model.php';
            $this->model = new URL_Model();
        }
        function indexAction() {
            $this->loadPage("test");
        }

        function inputAction() {
            if (isset($_POST['link'])) {
                if ($this->validateURL($_POST['link'])) {
                    $key_url = $this->addURL($_POST['link']);
                    if ($key_url) {
                        $data['new_link'] = DOMAIN . $key_url;
                        $this->loadPage("test", $data);
                    }
                    else {
                      // Báo lỗi do key không insert vào database được.
                    }
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
        private function generateRandomString() {
            $characters = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
            return substr($characters,0,6);
        }
        function validateKey($key){
            if($this->model->hasKey($key)){
                return false;
            }else{
              return true;
            }
        }

        function addURL($url){
            // Kiểm tra xem key được tạo ra có bị trùng với key đã có trước đó chưa
            do{
              $key = $this->generateRandomString();
            } while(!$this->validateKey($key));
            $result = $this->model->addNewKeyRecord($key,$url);
            if ($result){
              return $key;
            }
            else{
              return false;
            }
        }
        // Hàm kiểm tra URL được user input vào form.
        function validateURL($url){
            $input_url = strip_tags($url); // Lọc những tags của javascript để tránh XSS attack
            if (filter_var($input_url, FILTER_VALIDATE_URL)) {  // Kiểm tra xem input có phải URL không.
                return true;
            }
            else {
                return false;
            }
        }
    }
?>