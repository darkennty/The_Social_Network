<?php

require_once '../properties.php';

if (isset($_POST['user']) && isset($_POST['friend'])) {
    $user = $_POST['user'];
    $friend = $_POST['friend'];

    querySQL("DELETE FROM friends WHERE (user = '$user' AND friend = '$friend') OR (user = '$friend' AND friend = '$user')");
    querySQL("INSERT INTO friend_requests (sender, receiver) VALUES ('$friend', '$user')");
}