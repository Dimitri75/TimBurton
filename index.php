<?php
    session_start();
    include_once "pdo.php";
    include_once "header.html";


    $uri = $_SERVER['REQUEST_URI'];

    if ($uri == "/web/") {
        include_once "views/main.php";
    }
    else if ($uri == "/web/?admin_connection"){
        include_once "views/admin_connection.php";
    }

    include_once "footer.html";
?>

<script src="scripts/changeBackgroundOnScroll.js"></script>






