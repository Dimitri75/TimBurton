<?php
    function getMoviePoster($movieName){
        return "http://www.omdbapi.com/?t=" . urlencode($movieName) . "&plot=short&r=json";
    }
?>