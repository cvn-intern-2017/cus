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
                $result = $this->model->addAccessRecord($key,$this->getCurrentBrowser());
                if ($result){
                    $this->redirectURL($key);
                }
                else {
                    $this->loadPage("maintenance");
                }
            }else{
                $this->loadPage("404");
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
            $this->loadView("404");
          }
        }

        function goToOriginalLink($key){
            $originalUrl = $this->model->getURLByKey($key);
            if($originalUrl){
              header("Location: ".$originalUrl);
              exit;
            }else{
              $this->loadView("404");
            }
        }
        function getAnalysticsData($key) {
            $key = substr($key,0,6);
            $urlInfo = $this->model->getURLInfo($key);
            $data['original_link'] = $urlInfo->original_link;
            $data['created_time'] = $urlInfo->created_time;
            $accessInfo = $this->model->getAccessInfo($key);
            $data['total_click'] = $this->getTotalClick($accessInfo);
            foreach ($accessInfo as $accessItem){
                if($accessItem->browser == "Other") {
                    $data['other_click'] = $accessItem->number_of_clicks;
                }
                else if($accessItem->browser == "Chrome") {
                    $data['gg_click'] = $accessItem->number_of_clicks;
                }
                else {
                    $data['ff_click'] = $accessItem->number_of_clicks;
                }
            }
            return $data;
        }
        function getTotalClick($accessInfo){
            $result = 0;
            foreach ($accessInfo as $accessItem){
                $result = $result + $accessItem->number_of_clicks;
            }
            return $result;
        }
        function getCurrentBrowser(){
            // Tìm browser
           return "Chrome";
        }
        function gotoAnalyticsPage($key){
          $data = $this->getAnalysticsData($key);
          $this->loadView("analytics",$data);
        }


    }

?>
