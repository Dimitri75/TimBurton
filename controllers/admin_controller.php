<?php
    $uri = $_SERVER['REQUEST_URI'];
    if (isset($_GET['action'])){
        switch($_GET['action']){
            case "show_film":
                include_once "views/show_film.php";
                break;
            case "update_film":
                include_once "controllers/update_film.php";
                break;
            case "delete_film":
                include_once "controllers/delete_film.php";
                break;
            case "update_user":
                include_once "controllers/update_user.php";
                break;
            case "delete_user":
                include_once "controllers/delete_user.php";
                break;
            default:
                include_once "views/admin_table.php";
                break;
        }
    }
    else {
        switch ($uri) {
            case "/timburton/?admin_disconnection":
                include_once "controllers/admin_disconnection.php";
                break;
            case "/timburton/?create_user":
                include_once "controllers/create_user.php";
                break;
            case "/timburton/?create_film":
                include_once "controllers/create_film.php";
                break;
            case "/timburton/?gallery":
                include_once "views/gallery.php";
                break;
            default:
                include_once "views/admin_table.php";
                break;
        }
    }
?>