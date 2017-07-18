<?php
    define ('PATH_CONTROLLER', __DIR__.'\Controllers');
    define ('PATH_VIEW', __DIR__.'\Views');
    define ('PATH_MODEL', __DIR__.'\Models');
    include_once PATH_CONTROLLER . '\Base_Controller.php'; 
    include_once PATH_CONTROLLER . '\URL_Controller.php'; 
    $controllerObject = new URL_Controller();
    $controllerObject->indexAction();
?>