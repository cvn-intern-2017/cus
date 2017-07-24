<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    if ( ! defined('DOMAIN')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '\Base_Controller.php';
    class URL_Controller extends Base_Controller {
        private $_infoLink;
        function __construct() {
            require_once PATH_MODEL . '/URL_Model.php';
            $this->model = new URL_Model();
        }
        function indexAction() {
            $this->loadView("home");
        }

        function inputAction() {
              if (isset($_POST['link']) && $_POST['link'] !== '') {

                  if ($this->validateURL($_POST['link'])) {
                      $key_url = $this->addURL($_POST['link']);

                      if ($key_url) {

                          $data = $this->getLinkInfo($key_url);
                          $this->loadView("home", $data);
                      }
                      else {
                        // Báo lỗi do key không insert vào database được.
                          $this->loadView("maintenance");
                      }
                  }
                  else {
                        // Hiện pop up lỗi.
                      $this->loadView("home");
                  }
              }
              else {
                  $this->loadView("home");
                    // Hiện trang báo lỗi
              }
        }
        function getLinkInfo($key_url){
            $result = $this->model->getInfoByKey($key_url);
            $data['newLink'] = DOMAIN . $key_url; //
            $data['originalLink'] = $result->original_link;
            $data['originalLink64'] = substr($result->original_link,0,64).'[...]';
            $data['analysticDataLink'] = DOMAIN . $key_url . "+"; //
            return $data;
        }
        // Hàm trả về 1 chuổi random với mặc định là 6 kí tự.
        private function generateRandomString() {
            $characters = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
            return substr($characters,0,6);
        }
        function validateKey($key){
            if($this->model->getInfoByKey($key)){
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
