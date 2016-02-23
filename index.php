<?php

    session_start();
    include_once "pdo.php";
    include_once "header.php";

    $uri = $_SERVER['REQUEST_URI'];

    if (!isset($_SESSION['login'])){
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
                case "/web/?admin_signin":
                    include_once "views/admin_signin.php";
                    break;
                case "/web/?admin_connection":
                    include_once "controllers/admin_connection.php";
                    break;
                case "/web/?gallery":
                    include_once "views/gallery.php";
                    break;
                default:
                    include_once "views/main.php";
                    break;
            }
        }
    }
    else {
        if (isset($_GET['action'])){
            switch($_GET['action']){
                case "delete_user":
                    include_once "controllers/delete_user.php";
                    break;
                case "show_film":
                    include_once "views/show_film.php";
                    break;
                case "update_user":
                    include_once "controllers/update_user.php";
                    break;
                default:
                    include_once "views/admin_userTable.php";
                    break;
            }
        }
        else {
            switch ($uri) {
                case "/web/?admin_disconnection":
                    include_once "controllers/admin_disconnection.php";
                    break;
                case "/web/?create_user":
                    include_once "controllers/create_user.php";
                    break;
                case "/web/?gallery":
                    include_once "views/gallery.php";
                    break;
                default:
                    include_once "views/admin_userTable.php";
                    break;
            }
        }
    }

    include_once "footer.html";

?>

<script src="scripts/changeHeaderOnScroll.js"></script>