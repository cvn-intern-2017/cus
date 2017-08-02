<?php
    class Base_Controller{
      protected $model  = NULL;
      protected $smarty = NULL;

      function loadView($view, $data=array()){
          $this->smarty = new Cus_Smarty();
          $this->smarty->assign('view', PATH_VIEW . '/' . $view . '/' . $view . '.tpl');
          if (!empty($data)){
              $this->smarty->assign('data', $data);
          }
          $this->smarty->display("master_layout.tpl");
      }

    }
?>
