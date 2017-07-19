<?php
    class URL {
        private $_key; 
        private $_oldLink;
        private $_newLink;
        private $_created;
        private $_totalClick;
        private $_browser;
        function getKey(){
            return $this->_key;
        }
        function setKey($key){
            $this->_key = $key;
        }
        function getOldLink(){
            return $this->_oldLink;
        }
        function setOldLink($link){
            $this->_oldLink = $link;
        }
        function getNewLink(){
            return $this->_newLink;
        }
        function setNewLink($link){
            $this->_newLink = $link;
        }
        function getCreatedTime(){
            return $this->_created;
        }
        function setCreatedTime($time){
            $this->_created = $time;
        }
        function getTotalClick(){
            return $this->_totalClick;
        }
        function setTotalClick($totalClick){
            $this->_totalClick = $totalClick;
        }
        function getBrowser(){
            return $this->_browser;
        }
        function setBrowser($browser){
            $this->_browser = $browser;
        }
    }
?>