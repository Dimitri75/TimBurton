<?php

    function getMoviePosterOld($movieName){
        $query = "https://www.googleapis.com/customsearch/v1";
        $cx = "007358547476902121722:1vpylmrpooa";
        $apiKey = "AIzaSyA3qPMv3FRVifPhxteLskBzv5xzXaKUGbA";
        $query .= "?q=" . urlencode($movieName . " affiche");
        $query .= "&cx=" . urlencode($cx);
        $query .= "&key=" .urlencode($apiKey);
        return $query;
    }

    function getMoviePoster($movieName){
        $query = "http://www.omdbapi.com/?t=" . urlencode($movieName) . "&y=&plot=short&r=json";
        return $query;
    }
?>