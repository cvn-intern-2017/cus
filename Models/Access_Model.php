<?php

    class Access_Model extends Base_Model{

        function __construct(){
            parent::__construct();
        }

        function getOriginalLinkByKey($key){
            $this->setQuery("SELECT original_link FROM url WHERE key_url = ?");
            $result = $this->loadOneRecord(array($key));
            if($result){
                return $result->original_link;
            }
            else{
                return null;
            }
        }

        function insertAccessRecord($key,$browser,$clickedTimes){
            $this->setQuery("INSERT INTO access (id, browser, clicked_time) VALUES ((SELECT id FROM url WHERE key_url = ?), ?, ?)");
            $result = $this->execute(array($key,$browser,$clickedTimes));
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }

        function updateClickedTimeAccessRecord($key,$browser,$clickedTimes){
            $this->setQuery("UPDATE access SET clicked_time = ? WHERE id = (SELECT id FROM url WHERE key_url = ?) AND browser = ?");
            $result = $this->execute(array($clickedTimes,$key,$browser));
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }

        function checkURLKey($key) {
            $this->setQuery("SELECT 1 FROM url WHERE key_url = ?");
            $result = $this->loadOneRecord(array($key));
            if($result){
                return true;
            }
            else {
                return false;
            }
        }

        function findClickedTimeShortenURL($key,$browser){
            $this->setQuery("SELECT clicked_time FROM access, url WHERE url.id = access.id AND url.key_url = ? AND browser = ?");
            $result = $this->loadOneRecord(array($key,$browser));
            if($result){
                return $result->clicked_time;
            }
            else{
                return null;
            }
        }

        function findInfoLinkFromURL($key){
            $this->setQuery("SELECT original_link, created_time FROM url where key_url = ?");
            $result = $this->loadOneRecord(array($key));
            return $result;
        }

        function findInfoLinkFromAccess($key){
            $this->setQuery("SELECT browser, clicked_time FROM access, url where url.id = access.id AND key_url = ?");
            $result = $this->loadAllRecords(array($key));
            return $result;
        }
    }
?>
