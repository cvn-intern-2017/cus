<?php
    class Access_Controller extends Base_Controller{
        function __construct(){
            try{
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
        // Các hàm tương tác với model.
        function editClickedTimeShortenURL($key,$browser,$clickedTime){
            return $this->model->updateClickedTimeAccessRecord($key,$browser,$clickedTime);
        }

        function getClickedTimeShortenURL($key,$browser){
            return $this->model->findClickedTimeShortenURL($key,$browser);
        }

        function addNewAccessRecord($key,$browser,$time) {
            return $this->model->insertAccessRecord($key,$browser,$time);
        }

        function hasURLKeyInDatabase($key){
            return $this->model->checkURLKey($key);
        }
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
        /*
            Browser: Chrome   => 0
                     Firefox  => 1
                     Safari   => 2
                     Edge     => 3
                     IE       => 4
                     Other    => 5
        */
        function convertBrowserIdToRealName($browserId){
            switch ($browserId) {
                case 0:
                    return 'Chrome';
                case 1:
                    return 'Firefox';
                case 2:
                    return 'Safari';
                case 3:
                    return 'Edge';
                case 4:
                    return 'IE';
                default:
                    return 'Others';
            }
        }
        function getAnalysticsData($keyWithPlusChar){
            $infosLinkFromAccess = $this->model->findInfoLinkFromAccess(substr($keyWithPlusChar,0,-1));
            if (count($infosLinkFromAccess) > 0) {
                $data = array('total'=>0);
                foreach ($infosLinkFromAccess as $info) {
                    $timeArray = explode(' ',$info->clicked_time);
                    $browserName = $this->convertBrowserIdToRealName($info->browser);
                    $data['twohours'][$browserName] = 0;
                    $data['day'][$browserName]    = 0;
                    $data['month'][$browserName]  = 0;
                    $data['year'][$browserName]   = 0;
                    $data['alltime'][$browserName]= 0;
                    foreach($timeArray as $time){
                        $period = time() - $time;
                        if ($period < 7200){
                          $data['twohours'][$browserName]++;
                        }
                        if($period < 86400){
                            $data['day'][$browserName]++;
                        }
                        if($period < 86400*30){
                            $data['month'][$browserName]++;
                        }
                        if($period < 86400*365){
                            $data['year'][$browserName]++;
                        }
                        $data['alltime'][$browserName]++;
                        $data['total']++;
                    }
                }
            }
            $infosLinkFromURL = $this->model->findInfoLinkFromURL(substr($keyWithPlusChar,0,-1));
            $data['originallink'] = $infosLinkFromURL->original_link;
            $data['createdtime'] = $infosLinkFromURL->created_time;
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
