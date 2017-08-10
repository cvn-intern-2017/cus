<?php
    class Access_Controller extends Base_Controller{
        function __construct(){
            try{
                $this->model = new Access_Model();
            }
            catch (PDOException $e){
                $data =  substr($e->getMessage(),0,15);
                $this->goToMaintenancePage($data);
                exit();
            }
        }

        function indexAction() {
            try{
                $URIOnAddressBar = $_SERVER['REQUEST_URI'];
                $keyFromURL = $this->verifyKeyFromURI($URIOnAddressBar);
                //$keyFromURL.lenght can only be 6 or 7
                if(!$keyFromURL){
                    $this->goTo404Page();
                    return;
                }
                if (strlen($keyFromURL) === URL_KEY_WITH_PLUS_CHARS){
                    $this->goToAnalyticsPage($keyFromURL);
                    return;
                }
                $this->recordAboutNewLinkAccess($keyFromURL);
                $this->goToOriginalLink($keyFromURL);
            }
            catch (PDOException $e){
              $data =  substr($e->getMessage(),0,15);
              $this->goToMaintenancePage($data);
              exit();
            }
        }

        function recordAboutNewLinkAccess($keyFromURL) {
            $browserAccessURL = $this->detectCurrentBrowser();
            $retry = 0;
            $notDone = true;
            while($notDone && $retry < MAX_RETRY_ROLLBACK) {
                try{
                    // Start transaction with isolation level is SERIALIZABLE
                    $this->model->startTransaction('SERIALIZABLE');
                    $this->addNewLinkAccessRecord($keyFromURL,$browserAccessURL);
                    $this->model->commit();
                    $notDone = false;
                }
                catch (Exception $e){
                    $this->model->rollBack();
                    $retry++;
                }
            }
            if($retry >= MAX_RETRY_ROLLBACK){
                //MAX_RETRY_ROLLBACK exceeding, show maintenance page by exception.
                throw new PDOException();
            }
        }

        function addNewLinkAccessRecord($keyFromURL,$browserAccessURL){
            $clickedTimes = $this->model->findClickedTimeShortenURL($keyFromURL,$browserAccessURL);
            if($clickedTimes) {
                $clickedTimes = $clickedTimes . " " . time();
                  // if  update fail, show maintenance page by exception.
                $updateSuccess =  $this->model->updateClickedTimeAccessRecord($keyFromURL,$browserAccessURL,$clickedTimes);
            }
            else {
                  // if  insert fail, show maintenance page by exception.
                $insertSuccess = $this->model->insertAccessRecord($keyFromURL,$browserAccessURL,strval(time()));
            }
        }

        function hasURLKeyInDatabase($key){
            return $this->model->checkURLKey($key);
        }
        /*
          + Check URI
          + Check key_url's pattern
          + Check whether the key is in the database
          return key or null
        */
        function verifyKeyFromURI($URIOnAddressBar){
            $arrayOfURI = explode('/',$URIOnAddressBar);
            $keyFromURL = end($arrayOfURI);
            if(sizeof($arrayOfURI) === 2) {
                $lengthKey = strlen($keyFromURL);
                if($lengthKey == URL_KEY_CHARS){
                    $hasRightPattern = preg_match("/([A-Za-z0-9]){6}/",$keyFromURL);
                    if($hasRightPattern && $this->hasURLKeyInDatabase($keyFromURL)){

                        return $keyFromURL;
                    }
                }
                else if($lengthKey == URL_KEY_WITH_PLUS_CHARS){
                    $hasRightPattern = preg_match("/([A-Za-z0-9]){6}\+/",$keyFromURL);
                    if($hasRightPattern && $this->hasURLKeyInDatabase(substr($keyFromURL,0,URL_KEY_CHARS))){
                        return $keyFromURL;
                    }
                }
            }
            return null;
        }

        function convertBrowserIdToRealName($browserId){
            switch ($browserId) {
                case BROWSER_CHROME:
                    return 'Chrome';
                case BROWSER_FIREFOX:
                    return 'Firefox';
                case BROWSER_SAFARI:
                    return 'Safari';
                case BROWSER_EDGE:
                    return 'Edge';
                case BROWSER_IE:
                    return 'IE';
                default:
                    return 'Others';
            }
        }

        function getAnalysticsData($keyWithPlusChar){
            $infosLinkFromAccess = $this->model->findInfoLinkFromAccess(substr($keyWithPlusChar,0,-1));
            if ($infosLinkFromAccess) {
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
                        if ($period < NUM_SECOND_2HOURS){
                          $data['twohours'][$browserName]++;
                        }
                        if($period < NUM_SECOND_DAY){
                            $data['day'][$browserName]++;
                        }
                        if($period < NUM_SECOND_DAY*30){
                            $data['month'][$browserName]++;
                        }
                        if($period < NUM_SECOND_DAY*365){
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

        function detectCurrentBrowser(){
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            if (preg_match("/.*(Chrome\/).*(Safari\/)[0-9]*(.)[0-9]*$/",$userAgent)) {
                return BROWSER_CHROME;
            }
            else if(strpos($userAgent,'Safari/') !== false && strpos($userAgent,'Chrome/') === false){
                return BROWSER_SAFARI;
            }
            else if(strpos($userAgent,'MSIE') !== false){
                return BROWSER_IE;
            }
            else if(strpos($userAgent,'Firefox/') !== false){
                return BROWSER_FIREFOX;
            }
            else if(strpos($userAgent,'Edge/') !== false){
                return BROWSER_EDGE;
            }
            else{
                return BROWSER_OTHERS;
            }
        }

        function goToAnalyticsPage($key){
            $data = $this->getAnalysticsData($key);
            $this->loadView(PAGE_ANALYTICS,$data);
        }

        function goToMaintenancePage($data){
            $this->loadView(PAGE_MAINTENANCE,$data);
        }

        function goTo404Page(){
            $this->loadView(PAGE_404);
        }

        function goToOriginalLink($keyWithoutPlusChar){
            $originalLink = $this->model->getOriginalLinkByKey($keyWithoutPlusChar);
            echo $originalURL;
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
