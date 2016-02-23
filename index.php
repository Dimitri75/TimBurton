<?php

    session_start();
    include_once "pdo.php";
    include_once "header.php";

    $uri = $_SERVER['REQUEST_URI'];

    switch($uri){
        case "/web/":
            include_once "views/main.php";
            break;
        case "/web/?admin_userTable":
            include_once "views/admin_userTable.php";
            break;
        case "/web/?admin_signin":
            include_once "views/admin_signin.php";
            break;
        case "/web/?admin_connection":
            include_once "controllers/admin_connection.php";
            break;
        case "/web/?admin_disconnection";
            include_once "controllers/admin_disconnection.php";
        default:
            include_once "views/main.php";
            break;
    }

    include_once "footer.html";

?>

<script src="scripts/changeBackgroundOnScroll.js"></script>