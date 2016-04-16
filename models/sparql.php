<?php
    function getUrlDbpediaAbstract($term) {
        $format = 'json';

        $query = "PREFIX dbo: <http://dbpedia.org/ontology/>
                PREFIX : <http://dbpedia.org/resource/>

                SELECT *
                WHERE {
                :" . $term . " dbo:abstract ?abstract .
                FILTER (LANG(?abstract)='fr')
                }";

        $searchUrl = 'http://dbpedia.org/sparql?'
            .'query='.urlencode($query)
            .'&format='.$format;

        return $searchUrl;
    };

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