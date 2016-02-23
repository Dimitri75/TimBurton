<?php

    session_start();
    include_once "models/pdo.php";
    include_once "views/header.php";

    if (isset($_SESSION['login']))
        include_once 'controllers/admin_controller.php';
    else
        include_once 'controllers/guest_controller.php';

    include_once "views/footer.html";

?>

<script src="scripts/changeHeaderOnScroll.js"></script>