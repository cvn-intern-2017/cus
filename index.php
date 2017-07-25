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
function convert10BaseTo62Base($number10Base){
    $string62BaseChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $number62Base = '';
    while($number10Base >= 1){
        $remainder = $number10Base % 62;
        $number10Base = $number10Base / 62;
        $number62Base = substr($string62BaseChars,$remainder,1) . $number62Base;
    }
    while(strlen($number62Base)<6){
        if($number62Base){
            $number62Base = '0' . $number62Base;
        }
    }
    return $number62Base;
}
function convert62BaseTo10Base($number62Base) {
    $string62BaseChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $number10Base = 0;
    while (strlen($number62Base) >= 1){
        // Tìm vị trí của kí tự cuối cùng chuỗi $number62Base trong chuỗi $string62BaseChars
        // Ví dụ: $number62Base = 'abc' thì sẽ tính kí tự 'c' = 12
        $positionOfChar = strpos($string62BaseChars, substr($number62Base,0,1));
        $number10Base = $number10Base + pow(62,strlen($number62Base)-1) * $positionOfChar;
        $number62Base = substr($number62Base,1);
    }
    return $number10Base;
}
    // define ('PATH_CONTROLLER', __DIR__.'\Controllers');
    // define ('PATH_VIEW', __DIR__.'\Views');
    // define ('PATH_MODEL', __DIR__.'\Models');
    // define ('DOMAIN','http://cus.dev.cybozu.xyz/');
    // define ('PATH_LIB', __DIR__.'\lib');
    // define ('PATH_SMARTY', __DIR__.'\smarty');
    // include_once PATH_SMARTY .'\cusSmarty.php';
    // include_once PATH_CONTROLLER . '\URL_Controller.php';
    // include_once PATH_CONTROLLER . '\Access_Controller.php';
    // include_once PATH_LIB . '\Browser.php';
    // // Trường hợp vào giao diện input URL để nhận shortlink.
    // if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php') { // cybozu.xyz/
    // 		if(isset($_POST['link'])) {
    //
    // 			  $controllerObject = new URL_Controller();
    //        $controllerObject->inputAction();
    // 		}
    // 		else {
    // 			  $controllerObject = new URL_Controller();
    //        $controllerObject->indexAction();
    //    }
    // }
    // // Trường hợp vào shortlink hoặc vào trang data analystics. (Nên xét kĩ 2 trường hợp này ==> có thể có bug)
    // else {
    //   	$controllerObject = new Access_Controller();
    //   	$controllerObject->indexAction();
    // }

    $number10Base = 100;
    echo convert10BaseTo62Base($number10Base) . "<pre>";
    echo convert62BaseTo10Base(convert10BaseTo62Base($number10Base));
?>
