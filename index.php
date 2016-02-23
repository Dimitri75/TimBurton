<?php

    session_start();
    include_once "pdo.php";
    include_once "header.php";

    $uri = $_SERVER['REQUEST_URI'];

    switch($uri){
        case "/":
            include_once "views/main.php";
            break;
        case "/?admin_connection":
            include_once "views/admin_connection.php";
            break;
        case "/?admin_connect":
            include_once "controllers/admin_connect.php";
            break;
        case "/?admin_userTable":
            include_once "views/admin_userTable.php";
            break;
        case "/?admin_deconnection";
            include_once "controllers/admin_deconnect.php";
        default:
            include_once "views/main.php";
            break;
    }

    include_once "footer.html";

?>

<script src="scripts/changeBackgroundOnScroll.js"></script>