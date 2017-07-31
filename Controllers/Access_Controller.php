<?php
    if ( ! defined('PATH_CONTROLLER')) die ('Bad requested!');
    include_once PATH_CONTROLLER . '/Base_Controller.php';
    include_once 'Base_Controller.php';

    class Access_Controller extends Base_Controller{
        function __construct(){
            try{
                require_once PATH_MODEL . '/Access_Model.php';
                $this->model = new Access_Model();
            }
            catch (PDOException $e){
                $this->goToMaintenancePage();
                exit();
            }
        }
        // Lov
        function indexAction() {
            try{
                $URIOnAddressBar = $_SERVER['REQUEST_URI'];
                $keyFromURL = $this->verifyKeyFromURI($URIOnAddressBar);
                if($keyFromURL){
                    if (strlen($keyFromURL) == 6){
                        $browserAccessURL = $this->detectCurrentBrowser();
                        $clickedTimes= $this->getClickedTimeShortenURL($keyFromURL,$browserAccessURL);
                        if($clickedTimes) {
                            $clickedTimes = $clickedTimes . " " . time();
                            $updateSuccess = $this->editClickedTimeShortenURL($keyFromURL,$browserAccessURL,$clickedTimes);
                            if($updateSuccess) {
                                $this->redirectToRealURL($keyFromURL);
                            }
                        }
                        else {
                            $insertSuccess = $this->addNewAccessRecord($keyFromURL,$browserAccessURL,strval(time()));
                            if($insertSuccess){
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

        function getClickedTimeShortenURL($key,$browser){
            return $this->model->findClickedTimeShortenURL($key,$browser);
        }

        function addNewAccessRecord($key,$browser,$time) {
            return $this->model->insertAccessRecord($key,$browser,$time);
        }

        //Nam
        /*
          + Kiem tra URI
          + Kiem tra pattern cua key_url
          + Kiem tra key co trong database khong.
          return key or null
        */
        function verifyKeyFromURI($URIOnAddressBar){
            $arrayOfURI = explode('/',$URIOnAddressBar);
            $keyFromURL = end($arrayOfURI);
            if(sizeof($arrayOfURI) === 2) {
                $lengthKey = strlen($keyFromURL);
                if($lengthKey == 6){
                    $hasRightPattern = preg_match("/([A-Za-z0-9]){6}/",$keyFromURL);
                    if($hasRightPattern && $this->hasURLKeyInDatabase($keyFromURL)){
                        return $keyFromURL;
                    }
                }
                else if($lengthKey == 7){
                    $hasRightPattern = preg_match("/([A-Za-z0-9]){6}\+/",$keyFromURL);
                    if($hasRightPattern && $this->hasURLKeyInDatabase(substr($keyFromURL,0,6))){
                        return $keyFromURL;
                    }
                }
            }
            return null;
        }

        function hasURLKeyInDatabase($key){
            return $this->model->checkURLKey($key);
        }

        function redirectToRealURL($keyFromURL){
            $lengthKey = strlen($keyFromURL);
            if ($lengthKey == 6) {
              $this->goToOriginalLink($keyFromURL);
            }
            else if ($lengthKey == 7) {
              $this->goToAnalyticsPage($keyFromURL);
            }
            else{
              $this->goTo404Page();
            }
        }
// Loc $data['0_1'] 1 all time, 2 years, 3 month, 4 day, 5 2-hours
        function getAnalysticsData($keyWithPlusChar){
            $infosLinkFromAccess = $this->model->findInfoLinkFromAccess(substr($keyWithPlusChar,0,-1));
            if (count($infosLinkFromAccess) > 0) {
                $data = array();
                foreach ($infosLinkFromAccess as $info) {
                    $timeArray = explode(' ',$info->clicked_time);
                    //$data['type']['browser'] = 0;
                    $data['2hours'][$info->browser] = 0;
                    $data['day'][$info->browser]    = 0;
                    $data['month'][$info->browser]  = 0;
                    $data['year'][$info->browser]   = 0;
                    $data['alltime'][$info->browser]= 0;
                    foreach($timeArray as $time){
                        $period = time() - $time;
                        if ($period < 7200){
                          $data['2hours'][$info->browser]++;
                        }
                        if($period < 86400){
                            $data['day'][$info->browser]++;
                        }
                        if($period < 86400*30){
                            $data['month'][$info->browser]++;
                        }
                        if($period < 86400*365){
                            $data['year'][$info->browser]++;
                        }
                        $data['alltime'][$info->browser]++;
                    }
                }
            }
            echo "<pre>";
            print_r($data);
            echo "</pre>";
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
            switch($browser->getBrowser()){
                case 'Chrome':
                    return 0;
                case 'Firefox':
                    return 1;
                case 'Safari':
                    return 2;
                case 'Edge':
                    return 3;
                case 'Internet Explorer':
                    return 4;
                default:
                    return 5;
            }
        }
// Loc
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
                header("Location: " . $originalLink);
                exit;
            }
            else{
                $this->goTo404Page();
            }
        }
    }

?>
