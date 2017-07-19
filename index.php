<?php
    define ('PATH_CONTROLLER', __DIR__.'\Controllers');
    define ('PATH_VIEW', __DIR__.'\Views');
    define ('PATH_MODEL', __DIR__.'\Models');
    include_once PATH_CONTROLLER . '\URL_Controller.php';
    include_once PATH_CONTROLLER . '\Access_Controller.php';
    // Trường hợp vào giao diện input URL để nhận shortlink.
    if ($_SERVER['REQUEST_URI'] === '/cus/' || $_SERVER['REQUEST_URI'] === '/cus/index.php') { // cybozu.xyz/
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
/*$object = new URL_Controller();
var_dump($object->addURL('addURLadasdfasbj.com'));*/

?>
