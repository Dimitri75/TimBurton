<?php

    $root = "/web/";

    session_start();
    include_once "pdo.php";
    include_once "header.html";

    $uri = $_SERVER['REQUEST_URI'];

    switch($uri){
        case $root:
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
        default:
            include_once "views/main.php";
            break;
    }

    include_once "footer.html";

?>

<script src="scripts/changeBackgroundOnScroll.js"></script>