<?php
    function removeStringInParentheses($str){
        return preg_replace('/\([^)]+\)/',"",$str);
    }

    function removeUrl($url){
        if (filter_var($url, FILTER_VALIDATE_URL))
        $url = str_replace("http://dbpedia.org/resource/", "", $url);
        return $url;
    }

    function cleanDate($date){
        if (preg_match("/[0-9]{4}/", $date)){
            preg_match("/[0-9]{4}/", $date, $date);
            $date = $date[0];
        }
        return $date;
    }
?>