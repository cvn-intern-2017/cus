<?php
// function debug($key){
//   echo "<script>alert(".$key.")</script>";
// }
// function showArr($arr){
//   if (is_array($arr)) {
//     echo "<pre>";
//     print_r($arr);
//     echo "</pre>";
//   }
// }
// function convert10BaseTo62Base($number10Base){
//     $string62BaseChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $number62Base = '';
//     while($number10Base >= 1){
//         $remainder = $number10Base % 62;
//         $number10Base = $number10Base / 62;
//         $number62Base = substr($string62BaseChars,$remainder,1) . $number62Base;
//     }
//     while(strlen($number62Base)<6){
//         if($number62Base){
//             $number62Base = '0' . $number62Base;
//         }
//     }
//     return $number62Base;
// }

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

    function convert62BaseTo10Base($number62Base){
      $string62BaseChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $size = strlen($number62Base);
      $number10Base = strpos($string62BaseChars,$number62Base[0]);
      for ($i = 1; $i < $size; $i++ ){
        $number10Base = 62*$number10Base+strpos($string62BaseChars,$number62Base[$i]);
      }
      return $number10Base;
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
   $test = convert62BaseTo10Base('112ab8');
  echo $test." <=> ";
  $test2= convert10BaseTo62Base(931424954);
  echo $test2;

?>
