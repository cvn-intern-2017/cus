<?php
    define('DOMAIN','http://cus.dev.cybozu.xyz/');
    define('PATH_CONTROLLER',__DIR__ . '/Controllers');
    define('PATH_VIEW',__DIR__ . '/Views');
    define('PATH_MODEL',__DIR__ . '/Models');
    define('PATH_LIB',__DIR__ . '/lib');
    define('PATH_SMARTY',__DIR__ .'/smarty');
    define('ARR_INI',parse_ini_file('config/config.ini',true));
    define('INI_DATABSE',ARR_INI['database']);
    include_once PATH_SMARTY . '/Cus_Smarty.php';
    include_once PATH_CONTROLLER . '/URL_Controller.php';
    include_once PATH_CONTROLLER . '/Access_Controller.php';
    include_once PATH_LIB . '/Browser.php';
    include_once PATH_LIB . '/Utils.php';
    include_once PATH_MODEL . '/URL_Model.php';

    // Trường hợp vào giao diện input URL để nhận shortlink.
    if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php') { // cybozu.xyz/
    		if(isset($_POST['link'])){
            $_POST['link'] = trim($_POST['link']);
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
