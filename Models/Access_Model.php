<?php
    if ( ! defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '/Base_Model.php';
    class Access_Model extends Base_Model{
        function __construct(){
            parent::__construct();
        }

        function getOriginalLinkByKey($key){
            $this->setQuery("SELECT original_link FROM url where key_url = ?");
            $result = $this->loadOneRecord(array($key));
            if($result){
                return $result->original_link;
            }
            else{
                return null;
            }
        }

        function insertAccessRecord($key,$browser,$clickedTimes){
            $this->setQuery("INSERT INTO access (key_url,browser,clicked_time) VALUES (?,?,?)");
            $result = $this->execute(array($key,$browser,$clickedTimes));
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }

        function updateClickedTimeAccessRecord($key,$browser,$clickedTimes){
            $this->setQuery("UPDATE access SET clicked_time = ? WHERE key_url = ? AND browser = ?");
            $result = $this->execute(array($clickedTimes,$key,$browser,));
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }

        function checkURLKey($key) {
            $this->setQuery("SELECT 1 FROM url where key_url = ?");
            $result = $this->loadOneRecord(array($key));
            if($result){
                return true;
            }
            else {
                return false;
            }
        }

        function findClickedTimeShortenURL($key,$browser){
            $this->setQuery("SELECT clicked_time FROM access WHERE key_url = ? AND browser = ?");
            $result = $this->loadOneRecord(array($key,$browser));
            if($result){
                return $result->clicked_time;
            }
            else{
                return null;
            }
        }

        function getURLInfo($key){
            $this->setQuery("SELECT original_link, created_time FROM url WHERE key_url = ?");
            $result = $this->loadOneRecord(array($key));
            if($result){
                return $result;
            }
            else{
                return null;
            }
        }

        function getAccessInfo($key){
            $this->setQuery("SELECT count(key_url) AS number_of_clicks, browser FROM access WHERE key_short_link =  ? GROUP BY browser");
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
