<?php

require_once 'header.php';

require_once 'menu.php';

if (isset($_POST['text'])) {
    require_once 'profile_change.php';
}

$user = $_GET['view'] ?? $_SESSION['user'];

$result = querySQL("SELECT * FROM profiles WHERE user='$user'");

$row = $result->fetch();
$text = (isset($row['text']) && $row['text'] != '') ? $row['text'] : "No info about this blud";

$src = file_exists("avatars/photo_$user.jpg") ? "avatars/photo_$user.jpg" : "no_photo.jpg";

echo <<<_PROF
                <div class="user-info">
                    <img id="avatar" src="$src" alt="No_photO">
                    <div class="user-text">
                        <h4>$user</h4>
                        <p class="text">$text</p>  
                    </div>
                </div>
_PROF;