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
            $URIOnAddressBar = $_SERVER['REQUEST_URI'];
            // Key của trang web được lấy từ URL
            $keyFromURL  = end(explode('/',$URIOnAddressBar));
            if($this->isValidURL($keyFromURL)){
                if (strlen($keyFromURL) == 6){
                    $idFromKey = $this->
                    $insertSuccess = $this->model->insertNewAccessRecord($keyFromURL,$this->detectCurrentBrowser());
                    if ($insertSuccess){
                        $this->redirectToRealURL($keyFromURL);
                    }
                    else {
                        $this->goToMaintenancePage();
                    }
                }
                else {
                    $this->redirectToRealURL($keyFromURL);
                }
            }
            else{
                $this->goTo404Page();
            }
        }
        function isValidURL($keyFromURL){
            $lengthKey = strlen($keyFromURL);
            if($lengthKey == 6){
                return preg_match("/([A-Za-z0-9]){6}/",$keyFromURL);
            }
            else if($lengthKey == 7){
                return preg_match("/([A-Za-z0-9]){6}\+/",$keyFromURL);
            }
            else{
                return false;
            }
        }

        function redirectToRealURL($keyFromURL){
            $lengthKey = strlen($keyFromURL);
            if ($lengthKey==6) {
              $this->goToOriginalLink($keyFromURL);
            }
            else if ($lengthKey==7) {
              $this->goToAnalyticsPage($keyFromURL);
            }
            else{
              $this->goTo404Page();
            }
        }

        function getAnalysticsData($keyWithPlusChar) {
            $keyWithoutPlusChar = substr($keyWithPlusChar,0,6);

            $urlInfo = $this->model->getURLInfo($keyWithoutPlusChar);
            $data['short_link'] = DOMAIN . $keyWithoutPlusChar;
            $data['original_link'] = $urlInfo->original_link;
            $data['created_time'] = $urlInfo->created_time;

            $accessInfo = $this->model->getAccessInfo($keyWithoutPlusChar);
            $data['total_click'] = $this->computeTotalClick($accessInfo);
            $data['ff_click'] = 0;
            $data['gg_click'] = 0;
            $data['other_click'] = 0;

            foreach ($accessInfo as $accessItem){
                if($accessItem->browser == "Firefox") {
                    $data['ff_click'] = $accessItem->number_of_clicks;
                }
                else if($accessItem->browser == "Chrome") {
                    $data['gg_click'] = $accessItem->number_of_clicks;
                }
                else {
                    $data['other_click'] = $accessItem->number_of_clicks;
                }
            }
            return $data;
        }

        function computeTotalClick($accessInfo){
            $totalClick = 0;
            foreach ($accessInfo as $accessItem){
                $totalClick = $totalClick + $accessItem->number_of_clicks;
            }
            return $totalClick;
        }

        function detectCurrentBrowser(){
            $browser = new Browser();
            return $browser->getBrowser();
        }
        function goToAnalyticsPage($key){
            $data = $this->getAnalysticsData($key);
            $this->loadView("analytics",$data);
        }
        function goToMaintenancePage(){
            $this->loadView("maintenance");
        }
        function goTo404Page(){
            $this->loadView("404");
        }
        function goToOriginalLink($keyWithoutPlusChar){
            $originalLink = $this->model->getOriginalLinkByKey($keyWithoutPlusChar);
            if($originalLink){
                header("Location: ".$originalLink);
                exit;
            }
            else{
                $this->goTo404Page();
            }
        }
    }

?>
