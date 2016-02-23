<?php
    $action = $_GET['action'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "";

        $db = connectDB();
        $result = $db->query("DELETE FROM `film` WHERE id='".$id."'");
    }
    header('Location: /timburton');
?>