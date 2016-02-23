<?php

    session_start();
    include_once "pdo.php";
    include_once "header.php";

    $uri = $_SERVER['REQUEST_URI'];

    switch($uri){
        case "/web/":
            include_once "views/main.php";
            break;
        case "/web/?admin_connection":
            include_once "views/admin_connection.php";
            break;
        case "/web/?admin_connect":
            include_once "controllers/admin_connect.php";
            break;
        case "/web/?admin_userTable":
            include_once "views/admin_userTable.php";
            break;
        case "/web/?admin_deconnection";
            include_once "controllers/admin_deconnect.php";
        default:
            include_once "views/main.php";
            break;
    }

    include_once "footer.html";

?>

<script src="scripts/changeBackgroundOnScroll.js"></script>