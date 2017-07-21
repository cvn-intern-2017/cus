<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '\Base_Controller.php';

    include_once 'Base_Controller.php';
    class Access_Controller extends Base_Controller {
        function __construct() {
            require_once PATH_MODEL . '/Access_Model.php';
            $this->model = new Access_Model();
        }
        function indexAction() {
          $URLOnBar = $_SERVER['REQUEST_URI'];
          $arr      = explode('/',$URLOnBar);
          $key      = end($arr);
          $isValid  = $this->validateURL($key);
          if($isValid){
            $this->redirectURL($key);
          }else{
            $this->goTo404Page();
          }
        }
        function validateURL($key){
          $lengKey = strlen($key);
          if($lengKey == 6){
            return preg_match("/([A-Za-z0-9]){6}/",$key);
          }
          else if($lengKey == 7){
            return preg_match("/([A-Za-z0-9]){6}\+/",$key);
          }
          else{
            return false;
          }
        }

        function redirectURL($key){
          $lengKey = strlen($key);
          if ($lengKey==6) {
            $this->goToOriginalLink($key);
          }
          else if ($lengKey==7) {
            $this->gotoAnalyticsPage($key);
          }
          else{
            $this->goTo404Page();
          }
        }

        function goTo404Page(){
          echo "go to 404 page";
        }

        function goToOriginalLink($key){
          $originalUrl = $this->model->getURLByKey($key);
          if($originalUrl){
            header("Location: ".$originalUrl);
            exit;
          }else{
            $this->goTo404Page();
          }

        }

        function gotoAnalyticsPage(){
          echo "go to analytics page";
        }


    }

?>
