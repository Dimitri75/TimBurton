<?php

    session_start();
    include_once "pdo.php";
    include_once "header.php";

    if (isset($_SESSION['login']))
        include_once 'views/nav/admin_menu.php';
    else
        include_once 'views/nav/guest_menu.php';

    include_once "footer.html";

?>

<script src="scripts/changeHeaderOnScroll.js"></script>