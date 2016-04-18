<?php
    include_once("enumerations/image_enum.php");

    function getRandomImage($path)
    {
        $files = scandir($path);
        if(count($files) - 2 > 0){
            $arrayLength = count($files) - 2;
            return $path . "/" . $files[rand(0, $arrayLength - 1) + 2];
        }
        return "#";
    }
?>