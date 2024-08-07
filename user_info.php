<?php

require_once 'header.php';

require_once 'menu.php';

$user = $_GET['view'] ?? $_SESSION['user'];

$result = querySQL('SELECT * FROM members WHERE user="$user"');

$row = $result->fetch();
$text = $row['text'] ?? "No info about this blud";

$src = "no_photo.jpg";

if (file_exists("$user.jpg")) {
    $src = "$user.jpg";
}

echo <<<_PROF
                <div class="user-info">
                    <img id="avatar" src="$src" alt="No_photO">
                    <div class="user-text">
                        <h4>$user</h4>
                        <p class="text">$text</p>  
                    </div>
                </div>
_PROF;