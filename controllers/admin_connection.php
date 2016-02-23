<?php
    $db = connectDB();

    if (isset($_POST['login']) && isset($_POST['password'])) {
        $result = $db->query('SELECT * FROM user');
        $found = false;
        while ($found == false && ($data = $result->fetch())) {
            if ($data['login'] == $_POST['login'] && $data['password'] == $_POST['password']) {
                $_SESSION['login'] = $data['login'];
                $found = true;
            }
        }

        if($found)
            header('Location: ?admin_userTable');
    }

    header('Location: /timburton');
?>
