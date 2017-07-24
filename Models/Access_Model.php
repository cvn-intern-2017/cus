<?php
    if ( ! defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '\Base_Model.php';
    class Access_Model extends Base_Model{
        function __construct(){
            parent::__construct();
        }

        function getURLByKey($key){
            $this->setQuery("SELECT original_link FROM URL where key_link = ?");
            $results = $this->loadRow(array($key));
            if($results){
                return $results->original_link;
            }else{
                return null;
            }
        }
        function addAccessRecord($key, $browser){
            $this->setQuery("INSERT INTO access (key_short_link, browser) VALUES (?,?)");
            $result = $this->execute(array($key,$browser));
            if ($result){
                return true;
            }
            else{
                return false;
            }
        }
        function getURLInfo($key){
            $this->setQuery("SELECT original_link, created_time FROM URL where key_link = ?");
            $results = $this->loadRow(array($key));
            if($results){
                return $results;
            }else{
                return null;
            }
        }
        function getAccessInfo($key){
            $this->setQuery("SELECT count(id) AS number_of_clicks, browser FROM ACCESS WHERE key_short_link =  ? GROUP BY browser");
            $results = $this->loadAllRows(array($key));
            if($results){
                return $results;
            }else{
                return null;
            }
        }
    }
?>
