<?php

require_once '../properties.php';

set_time_limit(0);

if (isset($_GET['user']) && isset($_GET['friend']) && isset($_GET['stamp'])) {
    $randstr = substr(md5(rand()), 0, 7);
    $user = $_GET['user'];
    $friend = $_GET['friend'];
    $rowCount = $_GET['stamp'];

    $result = querySQL("SELECT * FROM messages WHERE (author='$user' AND recipent='$friend') OR (author='$friend' AND recipent='$user')");
    $newRowCount = $result->rowCount();

    if ($rowCount < $newRowCount) {
        echo "YES";
    } else {
        echo "NO";
    }
}