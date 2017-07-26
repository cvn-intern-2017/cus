<?php
    if ( ! defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '\Base_Model.php';
    class Access_Model extends Base_Model{
        function __construct(){
            parent::__construct();
        }

        function getOriginalLinkByKey($key){
            $this->setQuery("SELECT original_link FROM URL where key_url = ?");
            $result = $this->loadOneRecord(array($key));
            if($result){
                return $results->original_link;
            }
            else{
                return null;
            }
        }

<<<<<<< HEAD
        function insertAccessRecordToDatabase($key,$browser,$clickedTimes){
            $this->setQuery("INSERT INTO access (key_url,browser,clicked_time) VALUES (?,?,?)");
=======
        function insertNewAccessRecord($key, $browser){
            $this->setQuery("INSERT INTO access (key_url, browser) VALUES (?,?)");
>>>>>>> 4095955302dde6967a1b3c56be60be0d90a83c79
            $result = $this->execute(array($key,$browser));
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }

        function findClickedTimeShortenURL($key, $browser) {
            $this->setQuery("SELECT clicked_time FROM access where key_url = ? and browser = ?");
            $result = $this->loadOneRecord(array($key,$browser));
            if($result){
                return $result->clicked_time;
            }
            else{
                return null;
            }
        }

        function getURLInfo($key){
            $this->setQuery("SELECT original_link, created_time FROM URL where key_url = ?");
            $result = $this->loadOneRecord(array($key));
            if($result){
                return $result;
            }
            else{
                return null;
            }
        }

        function getAccessInfo($key){
            $this->setQuery("SELECT count(key_url) AS number_of_clicks, browser FROM ACCESS WHERE key_short_link =  ? GROUP BY browser");
            $results = $this->loadAllRecords(array($key));
            if($results){
                return $results;
            }
            else{
                return null;
            }
        }
    }
?>
