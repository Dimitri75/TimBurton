<?php
    $uri = $_SERVER['REQUEST_URI'];
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case "show_film":
                include_once "views/show_film.php";
                break;
            default:
                include_once "views/admin_userTable.php";
                break;
        }
    }
    else {
        switch ($uri) {
            case "/timburton/?admin_signin":
                include_once "views/admin_signin.php";
                break;
            case "/timburton/?admin_connection":
                include_once "controllers/admin_connection.php";
                break;
            case "/timburton/?gallery":
                include_once "views/gallery.php";
                break;
            default:
                include_once "views/main.php";
                break;
        }
    }
?>