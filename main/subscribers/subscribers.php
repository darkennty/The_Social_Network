<?php

/**
 * @var boolean $logged
 * @var string $randstr
 */

$_COOKIE['location'] = 'MATInder: My subs';

require_once '../page/header.php';

if (isset($_GET['view'])) {
    $blud = $_GET['view'];
    $result = querySQL("SELECT * FROM members WHERE user='$blud'");

    if ($result->rowCount() == 0) {
        $location = "Am I tweakin'?";
        require_once '../page/body.php';
        die("<div class='centered-text'><p>No such blud in our social network! Sorry.</p></div>");
    }
} else {
    $blud = $_SESSION['user'];
}

if ($_GET['view'] === $_SESSION['user']) {
    $location = "My subs";
} else {
    $location = "$blud's subs";
}

require_once '../page/body.php';

echo <<<_BLUDS
            <h4>$blud's  subscribers</h4>
_BLUDS;

$result = querySQL("SELECT * FROM friend_requests WHERE receiver='$blud'");

if ($result->rowCount() != 0) {
    echo "<div class='subscribers'>";
    while ($row = $result->fetch()) {
        $sub = $row['sender'];

        $src = file_exists("../../avatars/photo_$sub.jpg") ? "../../avatars/photo_$sub.jpg" : "../../images/no_photo.jpg";
        echo <<<_BLUD
                <div class="friend">
                    <img src='$src' alt='No_photO'><a href='../profile/profile.php?r=$randstr&view=$sub'>$sub</a>
                </div>
        _BLUD;
    }
} else {
    if ($_GET['view'] === $_SESSION['user'] || !isset($_GET['view'])) {
        echo <<<_NOBEACHES
            <div class="centered-text" style="position: relative; bottom: 10%">
                <p>You don't have any subs, man.</p>
            </div>
        _NOBEACHES;
    } else {
        echo <<<_NOBEACHES
            <div class="centered-text" style="position: relative; bottom: 10%">
                <p>This blud don't have any subs.</p>
            </div>
        _NOBEACHES;
    }
}

echo <<<_FIN
                
            </div>
        </div>
    </body>
</html> 
_FIN;




