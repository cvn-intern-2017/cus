<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '/Base_Controller.php';
    include_once 'Base_Controller.php';
    class Access_Controller extends Base_Controller {
        function __construct() {
            try{
              require_once PATH_MODEL . '/Access_Model.php';
              $this->model = new Access_Model();
            }
            catch (PDOException $e){
                $this->goToMaintenancePage();
                exit();
            }
        }

        function indexAction() {
            try{
                $URIOnAddressBar = $_SERVER['REQUEST_URI'];
                // Key của trang web được lấy từ URL
                $arrayOfURI = explode('/',$URIOnAddressBar);
                $keyFromURL  = end($arrayOfURI);
                if($this->isValidURI($arrayOfURI) && $this->isValidKey($keyFromURL)){
                    if (strlen($keyFromURL) == 6){
                        $browserAccessURL = $this->detectCurrentBrowser();
                        $clickedTimes= $this->getClickedTimeShortenURL($keyFromURL,$browserAccessURL);
                        if($clickedTimes) {
                            $clickedTimes = $clickedTimes . " " . strval(time());
                            $updateSuccess = $this->editClickedTimeShortenURL($keyFromURL,$browserAccessURL,$clickedTimes);
                            if($updateSuccess) {
                                $this->redirectToRealURL($keyFromURL);
                            }
                        }
                        else {
                            $insertSuccess = $this->addNewAccessRecord($keyFromURL,$browserAccessURL,strval(time()));
                            if($insertSuccess) {
                                $this->redirectToRealURL($keyFromURL);
                            }
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
            catch (PDOException $e){
                $this->goToMaintenancePage();
                exit();
            }
        }

        function editClickedTimeShortenURL($key,$browser,$clickedTime){
            return $this->model->updateClickedTimeAccessRecord($key,$browser,$clickedTime);
        }

        function getClickedTimeShortenURL($key, $browser) {

            return $this->model->findClickedTimeShortenURL($key,$browser);
        }

        function addNewAccessRecord($key,$browser,$time) {
            return $this->model->insertAccessRecord($key,$browser,$time);
        }

        function isValidURI($arrayOfURI){
            return sizeof($arrayOfURI) === 2;
        }

        function isValidKey($keyFromURL){
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

            foreach($accessInfo as $accessItem){
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
            switch ($browser->getBrowser()){
                case 'Chrome':
                    return 0;
                case 'Firefox':
                    return 1;
                case 'Safari':
                    return 2;
                case 'Edge':
                    return 3;
                case 'IE':
                    return 4;
                default:
                    return 5;
            }
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
