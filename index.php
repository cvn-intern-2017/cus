<?php
function debug($key){
  echo "<script>alert(".$key.")</script>";
}
function showArr($arr){
  if (is_array($arr)) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
  }
}

    define ('PATH_CONTROLLER', __DIR__.'\Controllers');
    define ('PATH_VIEW', __DIR__.'\Views');
    define ('PATH_MODEL', __DIR__.'\Models');
    define ('DOMAIN','http://cus.dev.cybozu.xyz/');
    define ('PATH_LIB', __DIR__.'\lib');
    define ('PATH_SMARTY', __DIR__.'\smarty');
    include_once PATH_SMARTY .'\cusSmarty.php';
    include_once PATH_CONTROLLER . '\URL_Controller.php';
    include_once PATH_CONTROLLER . '\Access_Controller.php';
    include_once PATH_LIB . '\Browser.php';
    // Trường hợp vào giao diện input URL để nhận shortlink.
    if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php') { // cybozu.xyz/
    		if(isset($_POST['link'])) {

    			$controllerObject = new URL_Controller();
          $controllerObject->inputAction();
    		}
    		else {
    			$controllerObject = new URL_Controller();
          $controllerObject->indexAction();
    		}
    }
    // Trường hợp vào shortlink hoặc vào trang data analystics. (Nên xét kĩ 2 trường hợp này ==> có thể có bug)
    else {
      	$controllerObject = new Access_Controller();
      	$controllerObject->indexAction();
    }


?>
