<?php

/**
 * @var string $randstr
 * @var boolean $logged
 */

$_COOKIE['location'] = 'MATInder: My members';

$location = "Members of MATInder";

require_once '../page/header.php';

require_once '../page/body.php';

echo <<<_BLUDS
            <h4>All members of MATInder (except you)</h4>
            <div class="members">
_BLUDS;

$result = querySQL("SELECT * FROM members");

while ($row = $result->fetch()) {
    $user = $row['user'];

    if ($_SESSION['user'] == $user) {
        continue;
    } else {
//        echo "<a href='../profile/profile.php?r=$randstr&view=$user'>$user</a><br />";
        $src = file_exists("../../avatars/photo_$user.jpg") ? "../../avatars/photo_$user.jpg" : "../../images/no_photo.jpg";

        echo <<<_BLUD
                <div class="friend">
                    <img src='$src' alt='No_photO'><a href='../profile/profile.php?r=$randstr&view=$user'>$user</a>
                </div>
        _BLUD;
    }
}

echo <<<_FIN
            </div>
        </div>
    </body>
</html> 
_FIN;




