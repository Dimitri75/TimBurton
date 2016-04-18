<?php

    include_once("enumerations/image_enum.php");

    function getRandomImage()
    {
        $path = ImageEnum::IMAGE_FOLDER;
        $files = scandir($path);
        if(count($files) - 2 > 0){
            $arrayLength = count($files) - 2;
            return $files[rand(0, $arrayLength - 1) + 2];
        }
        return "";
    }

?>