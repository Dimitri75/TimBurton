<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23/02/16
 * Time: 05:12
 */

include_once "../pdo.php";

$db = connectDB();


if (isset($_POST['login']) && isset($_POST['password'])) {
    $result = $db->query('select * from user');
    $trouve = false;
    while ($trouve == false && ($data = $result->fetch())) {
        if ($data['login'] == $_POST['login'] && $data['password'] == $_POST['password']) {
            $trouve = true;
        }
    }

    if($trouve)
        header('Location: /?admin_userTable');
}
