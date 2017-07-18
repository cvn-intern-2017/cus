<?php
    if ( ! defined('PATH_VIEW')) die ('Bad requested!');
    class Base_Controller {
        protected $model = NULL;
        private $__content = array();
        function __construct() 
        {
            require_once PATH_MODEL . '/CUS_Model.php';
            $this->model = new CUS_Model();
        }
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
            $this->__content[] = $content;
            
        }
        // Sử dụng hàm loadView ở trên để loadView(header), loadView(footer)
        function loadHeader() {
        }
        function loadFooter() {
        }
        function __destruct() {
            foreach ($this->__content as $html){
                echo $html;
            }
        }
    }
?>