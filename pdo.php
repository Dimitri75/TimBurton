<?php
    try {
        $db = new PDO('mysql:host=localhost; dbname=timburton; charset=utf8', 'root', '');
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>