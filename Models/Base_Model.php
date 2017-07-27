<?php
class Base_Model {
    //Giá trị trả về sau khi tạo object trên (được gán vào biến $_databaseHandle) được gọi là database handler và object này sẽ được dùng xuyên suốt trong quá trình kết nối với CSDL.
    private static $_databaseHandle;
    private $_sql = '';
    private $_cursor = NULL; // nhận kết quả sau khi prepare câu SQL
    // Khai báo thông tin database và server kết nối.
    private $_servername = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "cus";

    public function __construct() {
        if(!self::$_databaseHandle) {
            $this->_databaseHandle = new PDO('mysql:host='.$this->_servername.'; dbname='.$this->_database,$this->_username,$this->_password);
            $this->_databaseHandle->query('set names "utf8"');
            $this->_databaseHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

      public function disconnect() { // ngắt kết nối
  	  	  $this->_databaseHandle = NULL;
  	  }

	    public function setQuery($sql) {
          $this->_sql = $sql;
      }

	    public function getLastId() {
          return $this->_databaseHandle->lastInsertId();
      }

    // execute the query
    public function execute($options=array()) {
        $this->_cursor = $this->_databaseHandle->prepare($this->_sql);
    		if($options) {  // Bind Parameter
      			for($i=0;$i<count($options);$i++) {
      			     $this->_cursor->bindParam($i+1,$options[$i]);
      			}
		    }
    		$this->_cursor->execute();
    		return $this->_cursor;
    }

	//Funtion load tất cả Rows ở table
    public function loadAllRecords($options=array()) {
        if(!$options) {
            if(!$result = $this->execute())
                return false;
        }else {
            if(!$result = $this->execute($options))
                return false;
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function loadOneRecord($option=array()) {
        if(!$option) {
            if(!$result = $this->execute())
                return false;
        }
        else {
            if(!$result = $this->execute($option))
                return false;
        }
        return $result->fetch(PDO::FETCH_OBJ);
	}

	public function insert($table,$option = array()){
  		$count = count($option);
  		if ($count>0) {
    			$sql='Insert INTO '.$table.' values ('.substr(str_repeat('?,', $count),0,-1).')';
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
