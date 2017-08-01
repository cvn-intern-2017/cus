<?php
    function convert10BaseTo62Base($number10Base){
        $string62BaseChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $number62Base = '';
        while($number10Base >= 1){
            $remainder = $number10Base % 62;
            $number10Base = $number10Base / 62;
            $number62Base = substr($string62BaseChars,$remainder,1) . $number62Base;
        }
        while(strlen($number62Base) < 6){
            if($number62Base){
                $number62Base = '0' . $number62Base;
            }
        }
        return $number62Base;
    }
    function convert62BaseTo10Base($number62Base){
        $string62BaseChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $size = strlen($number62Base);
        $number10Base = strpos($string62BaseChars,$number62Base[0]);
        for ($i = 1; $i < $size; $i++){
            $number10Base = 62*$number10Base+strpos($string62BaseChars,$number62Base[$i]);
        }
        return $number10Base;
    }


 ?>
