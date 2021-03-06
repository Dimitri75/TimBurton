<?php
    function constructQuery($subject, $predicates){
        //if (filter_var($subject, FILTER_VALIDATE_URL))
        $subject = "<".$subject.">";

        return SparqlEnum::PREFIX .
            "SELECT *
            WHERE {
            ".$subject." ".$predicates."
            }";
    }

    function getSearchUrl($query){
        return 'http://dbpedia.org/sparql?'
            . 'query='.urlencode($query)
            . '&format='.SparqlEnum::FORMAT;
    }

    function resultFromQuery($searchUrl){
        return json_decode(request($searchUrl), true);
    }

    function resultFromQueryForImages($url){
        $json = file_get_contents($url);
        return json_decode($json);
    }

    function request($url){
        // Is curl installed ?
        if (!function_exists('curl_init'))
            die('CURL is not installed!');

        // Get curl handler
        $curlHandler = curl_init();

        // Set request url
        curl_setopt($curlHandler,
            CURLOPT_URL,
            $url);

        // Return response, don't print/echo
        curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curlHandler);
        curl_close($curlHandler);
        return $response;
    }
?>