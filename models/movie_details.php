<?php
    function getMoviePoster($movieName){
        return "http://www.omdbapi.com/?t=" . urlencode($movieName) . "&y=&plot=short&r=json";
    }
?>