@php
    function nameLimiter($str){
        $len = 15;
        if (mb_strlen($str)>$len) {
            return   mb_substr($str, 0 , $len)."...";
        }
        else {
            return $str;
        }
    }
@endphp
