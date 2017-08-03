<?php
     require_once PATH_SMARTY . 'libs/Smarty.class.php';
     class Cus_Smarty extends Smarty{
         function __construct(){
             parent::__construct();
             $this->debugging = false;
             //$smarty->caching= false;
             //$smarty->cache_lifetime = 60;
             $this->setCompileDir(PATH_VIEW . '/templates_c/');
             $this->setConfigDir(PATH_CONFIG);
             $this->setCacheDir(PATH_SMARTY . '/cache/');
             $this->setTemplateDir(PATH_VIEW . '/common/');
         }
     }
