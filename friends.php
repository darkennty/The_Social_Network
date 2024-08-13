<?php

/**
 * @var boolean $logged
 * @var string $randstr
 * @var string $user
 */

$_COOKIE['location'] = 'MATInder: My bluds';

require_once 'header.php';

if ($_GET['view'] == $_SESSION['user']) {
    $location = "My bluds";
} else {
    $location = "$user's profile";
}

require_once 'menu.php';

$user = $_GET['view'] ?? $_SESSION['user'];

echo <<<_BLUDS
            <h4>$user's  bluds</h4>
            <div class="friends">
_BLUDS;

$result = querySQL("SELECT * FROM friends WHERE user='$user' OR friend='$user'");

if ($result->rowCount() != 0) {
    while ($row = $result->fetch()) {
        $friend = $user == $row['user'] ? $row['friend'] : $row['user'];

        $src = file_exists("avatars/photo_$friend.jpg") ? "avatars/photo_$friend.jpg" : "no_photo.jpg";
        echo <<<_BLUD
                <div class="friend">
                    <img src='$src' alt='No_photO'><a href='profile.php?r=$randstr&view=$friend'>$friend</a>
                </div>
        _BLUD;
    }
} else {
    echo "<p>You don't have any friends, man.</p>";
}

echo <<<_FIN
                
            </div>
        </div>
    </body>
</html> 
_FIN;




