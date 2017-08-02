<?php
    class Base_Model{
        private static $_databaseHandle;
        private $_sql = '';
        private $_cursor = NULL;

        private $_servername  = INI_DATABSE['servername'];
        private $_username    = INI_DATABSE['username'];
        private $_password    = INI_DATABSE['password'];
        private $_database    = INI_DATABSE['dbname'];

        public function __construct(){
            if(!self::$_databaseHandle){
                $this->_databaseHandle = new PDO('mysql:host=' . $this->_servername . '; dbname=' . $this->_database,$this->_username,$this->_password);
                $this->_databaseHandle->query('set names "utf8"');
                $this->_databaseHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }

        public function disconnect(){
    	  	  $this->_databaseHandle = NULL;
    	  }

        public function setQuery($sql){
            $this->_sql = $sql;
        }

        public function getLastId(){
            return $this->_databaseHandle->lastInsertId();
        }

        public function execute($options=array()){
            $this->_cursor = $this->_databaseHandle->prepare($this->_sql);
        		if($options){
          			for($i = 0; $i < count($options); $i++) {
          			     $this->_cursor->bindParam($i + 1,$options[$i]);
          			}
    		    }
        		$this->_cursor->execute();
        		return $this->_cursor;
        }

        public function loadAllRecords($options = array()){
            if(!$options) {
                if(!$result = $this->execute()){
                    return false;
                }
            }else{
                if(!$result = $this->execute($options)){
                    return false;
                }
            }
            return $result->fetchAll(PDO::FETCH_OBJ);
        }

        public function loadOneRecord($option = array()){
            if(!$option) {
                if(!$result = $this->execute()){
                    return false;
                }
            }
            else{
                if(!$result = $this->execute($option)){
                    return false;
                }
            }
            return $result->fetch(PDO::FETCH_OBJ);
      	}

      	public function insert($table,$option = array()){
        		$count = count($option);
        		if($count > 0){
          			$sql = 'INSERT INTO ' . $table . ' VALUES (' . substr(str_repeat('?,', $count),0,-1) . ')';
          			$this->setQuery($sql);
          			$result = $this->execute($option);
        		}
        		if($result){
          			return $this->getLastId();
        		}
            else{
          			return false;
        		}
      	}
    }
?>
