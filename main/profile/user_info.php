<?php

require_once '../page/header.php';

$profile_user = $_GET['view'] ?? $_SESSION['user'];
$result = querySQL("SELECT * FROM members WHERE user='$profile_user'");

if ($result->rowCount() == 0) {
    $location = "Am I tweakin'?";
    require_once '../page/menu.php';
    die("<div class='centered-text'><p>No such blud in our social network! Sorry.</p></div>");
}

if ($_GET['view'] == $_SESSION['user']) {
    $location = "My profile";
} else {
    $location = "$profile_user's profile";
}

require_once '../page/menu.php';

if (isset($_POST['text'])) {
    require_once 'profile_change.php';
}

if ($result->rowCount() != 0) {
    $result = querySQL("SELECT * FROM profiles WHERE user='$profile_user'");

    $row = $result->fetch();
    $text = (isset($row['text']) && $row['text'] != '') ? $row['text'] : "No info about this blud";

    $src = file_exists("../../avatars/photo_$profile_user.jpg") ? "../../avatars/photo_$profile_user.jpg" : "../../images/no_photo.jpg";

    echo <<<_PROF
                    <div class="user-info">
                        <div class="avatar-div">
                            <img id="avatar" src="$src" alt="No_photO">
                        </div>
                        <div class="user-text">
                            <h4 style="margin-top: 0;">$profile_user</h4>
                            <p class="text">$text</p>  
                        </div>
                    </div>
    _PROF;
} else {
    die("<div class='centered-text'><p>No such blud in our social network! Sorry.</p></div>");
}

