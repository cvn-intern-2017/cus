<?php
   require_once 'libs/Smarty.class.php';

     class Cus_Smarty extends Smarty{
         function __construct(){
             parent::__construct();
             $this->debugging = false;
             //$smarty->caching= false;
             //$smarty->cache_lifetime = 60;
             $this->setCompileDir(PATH_SMARTY . '/templates_c/');
             $this->setConfigDir(PATH_SMARTY . '/config/');
             $this->setCacheDir(PATH_SMARTY . '/cache/');
             $this->setTemplateDir(PATH_SMARTY . '/templates/');
         }
     }
