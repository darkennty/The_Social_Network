<?php

require_once '../properties.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $user = $_POST['user'];

    $result = querySQL("SELECT * FROM messages WHERE id = '$id'");

    if ($result->rowCount() != 0) {
        $row = $result->fetch();
        if ($row['author'] == $user) {
            $result = querySQL("DELETE FROM messages WHERE id='$id';");
        }
    }
}