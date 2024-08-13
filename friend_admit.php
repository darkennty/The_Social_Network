<?php

require_once 'properties.php';

if (isset($_POST['user']) && isset($_POST['friend'])) {
    $user = $_POST['user'];
    $friend = $_POST['friend'];

    querySQL("INSERT INTO friends(user, friend) VALUES ('$user','$friend')");
    querySQL("DELETE FROM friend_requests WHERE sender = '$user'   AND receiver = '$friend'");
    querySQL("DELETE FROM friend_requests WHERE sender = '$friend' AND receiver = '$user'");
}