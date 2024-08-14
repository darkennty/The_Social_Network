<?php

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $result = querySQL("SELECT * FROM profiles WHERE user='$user'");

    if (isset($_POST['text'])) {
        $text = sanitize($_POST['text']);
        $text = preg_replace('/\s\s+/', ' ', $text);
        if ($result->rowCount()) {
            querySQL("UPDATE profiles SET text='$text' where user='$user'");
        } else {
            querySQL("INSERT INTO profiles VALUES('$user', '$text')");
        }
    }

    if (isset($_FILES['image']['name'])) {
        $source = "../../avatars/photo_$user.jpg";
        move_uploaded_file($_FILES['image']['tmp_name'], $source);
    }
}
