<?php
class Base_Model {
    private static $_dbh; //Giá trị trả về sau khi tạo object trên (được gán vào biến $DBH) được gọi là database handler và object này sẽ được dùng xuyên suốt trong quá trình kết nối với CSDL.
    private $_sql = '';
    private $_cursor = NULL; // nhận kết quả sau khi prepare câu SQL
    // Khai báo thông tin database và server kết nối.
    private $_servername = "localhost";
    private $_username = "root";
    private $_password = "";
    private $_database = "cus";

    public function __construct() {
        try{
            if(!self::$_dbh) {
              $this->_dbh = new PDO('mysql:host='.$this->_servername.'; dbname='.$this->_database,$this->_username,$this->_password);
              $this->_dbh->query('set names "utf8"');
              $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
        catch(PDOException $e){
            exit('Không kết nối được cơ sở dữ liệu: '.$e->getMessage());
        }
    }

      public function disconnect() { // ngắt kết nối
  	  	$this->_dbh = NULL;
  	  }

	    public function setQuery($sql) {
        $this->_sql = $sql;
      }

	    public function getLastId() {
        return $this->_dbh->lastInsertId();
      }

    // execute the query
    public function execute($options=array()) {
        $this->_cursor = $this->_dbh->prepare($this->_sql);
    		if($options) {  // Bind Parameter
      			for($i=0;$i<count($options);$i++) {
      				$this->_cursor->bindParam($i+1,$options[$i]);
      			}
		    }
    		$this->_cursor->execute();
    		return $this->_cursor;
    }


	//Funtion load tất cả Rows ở table
    public function loadAllRows($options=array()) {
        if(!$options) {
            if(!$result = $this->execute())
                return false;
        }else {
            if(!$result = $this->execute($options))
                return false;
        }
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    //Funtion load 1 data on the table

    public function loadRow($option=array()) {
        if(!$option) {
            if(!$result = $this->execute())
                return false;
        }else {
            if(!$result = $this->execute($option))
                return false;
        }
        return $result->fetch(PDO::FETCH_OBJ);
	}



	public function insert($table,$option = array()){
  		$count = count($option);
  		//echo substr(str_repeat('?,', $count),0,-1); create number of ? commensurate with number of element in array
  		if ($count>0) {
  			$sql='Insert INTO '.$table.' values ('.substr(str_repeat('?,', $count),0,-1).')';
  			$this->setQuery($sql);
  			$result = $this->execute($option);
  		}
  		if($result){
  			return $this->getLastId();
  		}else{
  			return false;
  		}
		//return $this->getLastId(); // >0 success !!
	}
}

/*
   $object  = new Base_Model();
   $object->setQuery("SELECT * FROM URL WHERE key_link = ?");

   $results = $object->loadAllRows(array('123456'));
   echo "<pre>";
   print_r($results);
   echo "</<pre>";
   */
?>
