<?php
require_once 'properties.php';

if (isset($_POST['user'])) {
    $user = sanitize($_POST['user']);
    $result = querySQL("SELECT * FROM members WHERE user='$user'");

    if ($result->rowCount()) {
        echo "<span class='taken'>&nbsp;&#x2718; " .
            "Hell naw! This username '$user' is taken</span>";
    }
    else {
        echo "<span class='available'>&nbsp;&#x2714; " .
            "Okay, Kylie, okay! This username '$user' is available</span>";
    }
}
?>