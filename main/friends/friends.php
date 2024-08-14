<?php

/**
 * @var boolean $logged
 * @var string $randstr
 */

$_COOKIE['location'] = 'MATInder: My bluds';

require_once '../page/header.php';

if (isset($_GET['view'])) {
    $blud = $_GET['view'];
    $result = querySQL("SELECT * FROM members WHERE user='$blud'");

    if ($result->rowCount() == 0) {
        $location = "Am I tweakin'?";
        require_once '../page/menu.php';
        die("<div class='centered-text'><p>No such blud in our social network! Sorry.</p></div>");
    }
} else {
    $blud = $_SESSION['user'];
}

if ($_GET['view'] === $_SESSION['user']) {
    $location = "My bluds";
} else {
    $location = "$blud's bluds";
}

require_once '../page/menu.php';

echo "<h4>$blud's  bluds</h4>";

$result = querySQL("SELECT * FROM friends WHERE user='$blud' OR friend='$blud'");

if ($result->rowCount() != 0) {
    echo "<div class='friends'>";
    while ($row = $result->fetch()) {
        $friend = $blud == $row['user'] ? $row['friend'] : $row['user'];

        $src = file_exists("../../avatars/photo_$friend.jpg") ? "../../avatars/photo_$friend.jpg" : "../../images/no_photo.jpg";
        echo <<<_BLUD
                <div class="friend">
                    <img src='$src' alt='No_photO'><a href='../profile/profile.php?r=$randstr&view=$friend'>$friend</a>
                </div>
        _BLUD;
    }
} else {
    echo <<<_NOFRIENDS
            <div class="centered-text" style="position: relative; bottom: 10%">
                <p>You don't have any friends, man.</p>
            </div>
    _NOFRIENDS;
}

echo <<<_FIN
                
            </div>
        </div>
    </body>
</html> 
_FIN;




