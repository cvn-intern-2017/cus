<?php
    if ( ! defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '/Base_Model.php';
    class Access_Model extends Base_Model{
        function __construct(){
            parent::__construct();
        }
// Loc
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
            $this->setQuery("SELECT clicked_time FROM access WHERE key_url = ? AND browser = ?");
            $result = $this->loadOneRecord(array($key,$browser));
            if($result){
                return $result->clicked_time;
            }
            else{
                return null;
            }
        }
// Hang
    }
?>
