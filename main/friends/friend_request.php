<?php

require_once '../properties.php';

if (isset($_POST['user']) && isset($_POST['friend'])) {
    $user = $_POST['user'];
    $friend = $_POST['friend'];

    querySQL("INSERT INTO friend_requests(sender, receiver) VALUES ('$user','$friend')");
}
