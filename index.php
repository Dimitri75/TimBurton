<?php

    session_start();
    include_once "pdo.php";
    include_once "header.php";

    $uri = $_SERVER['REQUEST_URI'];

    if (!isset($_SESSION['login'])){
        switch($uri){
            case "/web/?admin_signin":
                include_once "views/admin_signin.php";
                break;
            case "/web/?admin_connection":
                include_once "controllers/admin_connection.php";
                break;
            default:
                include_once "views/main.php";
                break;
        }
    }
    else {
        switch($uri){
            case "/web/?admin_disconnection";
                include_once "controllers/admin_disconnection.php";
            default:
                include_once "views/admin_userTable.php";
                break;
        }
    }


    include_once "footer.html";

?>

<script src="scripts/changeHeaderOnScroll.js"></script>