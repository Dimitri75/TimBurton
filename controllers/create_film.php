<?php
    $db = connectDB();

    if (isset($_POST['name']) && isset($_POST['resume'])) {
        $name = $_POST['name'];
        $resume = $_POST['resume'];
        $date = null;
        $note = null;
        $illustration = null;

        if (isset($_POST['date']) && !empty($_POST['date']))
            $date = $_POST['date'];

        if (isset($_POST['note']) && !empty($_POST['note']))
            $note = $_POST['note'];

        if (isset($_POST['illustration']) && !empty($_POST['illustration']))
            $illustration = $_POST['illustration'];

        $req = $db->prepare("INSERT INTO film(name, resume, date, note, illustration) VALUES (:name, :resume, :date, :note, :illustration)");
        $req->execute(array(
            "name" => $name,
            "resume" => $resume,
            "date" => $date,
            "note" => $note,
            "illustration" => $illustration
        ));
    }
    header('Location: /timburton');
?>