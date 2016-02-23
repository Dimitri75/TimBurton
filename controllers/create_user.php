<?php
    $db = connectDB();

    if (isset($_POST['login']) && isset($_POST['password1']) && isset($_POST['password2']) && ($_POST['password1'] == $_POST['password2'])) {
        $login = $_POST['login'];
        $password = $_POST['password1'];

        $req = $db->prepare("INSERT INTO user(login, password) VALUES (:login, :password)");
        $req->execute(array(
            "login" => $login,
            "password" => $password
        ));
    }
    header('Location: /timburton');
?>