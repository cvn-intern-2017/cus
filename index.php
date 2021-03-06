<?php
    define('DOMAIN','http://cus.dev.cybozu.xyz');
    define('PATH_CONTROLLER',__DIR__ . '/Controllers/');
    define('PATH_VIEW',__DIR__ . '/Views/');
    define('PATH_MODEL',__DIR__ . '/Models/');
    define('PATH_LIB',__DIR__ . '/lib/');
    define('PATH_SMARTY',__DIR__ . '/vendor/smarty/smarty/');
    define('PATH_CONFIG',__DIR__ . '/configure/');
    define('PATH_PUBLIC',DOMAIN . '/public/');
    define('ARR_INI',parse_ini_file('configure/config.ini',true));
    define('INI_DATABSE',ARR_INI['database']);
    // Constant number.
    define('URL_KEY_CHARS',6);
    define('URL_KEY_WITH_PLUS_CHARS',7);
    define('MAX_RETRY_ROLLBACK',10);
    define('MAX_URL_CHARS',65234);
    define('NUM_SECOND_2HOURS',7200);
    define('NUM_SECOND_DAY',86400);
    // Constant Browser
    define('CHROME_NUM',0);
    define('FIREFOX_NUM',1);
    define('SAFARI_NUM',2);
    define('EDGE_NUM',3) ;
    define('INTERNET_EXPLORER_NUM',4);
    define('OTHER_BROWSER_NUM',5);
    // Constant View page
    define('PAGE_MAINTENANCE','maintenance');
    define('PAGE_404','404');
    define('PAGE_ANALYTICS','analytics');
    define('PAGE_HOME','home');

    include_once PATH_LIB . 'Utils.php';
    // In case access PAGE_HOME to get shortlink.
    if($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php') {
    		if(isset($_POST['submit'])){
    			  $controllerObject = new URL_Controller();
            $controllerObject->inputAction();
    		}
    		else{
    		    $controllerObject = new URL_Controller();
            $controllerObject->indexAction();
        }
    }
    // In case redirect originalURL or PAGE_ANALYTICS.
    else{
      	$controllerObject = new Access_Controller();
      	$controllerObject->indexAction();
    }

?>
