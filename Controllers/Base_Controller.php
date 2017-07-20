<?php
    if ( ! defined('PATH_VIEW')) die ('Bad requested!');
    class Base_Controller {
        protected $model = NULL;
        private $_content = array();
        /* Chức năng: Đổ dữ liệu vào view
            $view : tham số view.
            $data: Dữ liệu cần nhứng vào view.
            Return: Chuỗi HTML của view sau khi được nhứng data.
        */
        function loadView($view, $data=array()) {
            extract($data);
            ob_start();
            require_once PATH_VIEW . '/' . $view . '.php';
            $content = ob_get_contents();
            ob_end_clean();
            $this->_content[] = $content;

        }
        // Sử dụng hàm loadView ở trên để loadView('header'), loadView('footer')
        function loadHeader() {
            $this->loadView('header');
        }
        function loadFooter() {
            $this->loadView('footer');
        }
        function loadPage($view, $data=array()) {
            $this->loadHeader();
            $this->loadView($view, $data);
            $this->loadFooter();
        }
        function __destruct() {
            foreach ($this->_content as $html){
                echo $html;
            }
        }
    }
?>
