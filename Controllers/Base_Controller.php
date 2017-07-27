<?php
    if ( ! defined('PATH_VIEW')) die ('Bad requested!');
    if ( ! defined('PATH_SMARTY')) die ('Bad requested!');

    class Base_Controller {
      public $model  = NULL;
      protected $smarty = NULL;
      /*

      */
      function loadView($view, $data=array()){
          require_once PATH_SMARTY . '/cusSmarty.php';
          $this->smarty = new cusSmarty();
          $this->smarty->assign('view', PATH_VIEW.'/'.$view.'/'.$view.'.tpl');
          if (!empty($data)) {
              $this->smarty->assign('data', $data);
          }
          $this->smarty->display("master_layout.tpl");
      }
      
    }
?>
