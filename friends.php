<?php

/**
 * @var boolean $logged
 * @var string $randstr
 */

$_COOKIE['location'] = 'MATInder: My bluds';

require_once 'header.php';

require_once 'menu.php';

$user = $_GET['view'] ?? $_SESSION['user'];

echo <<<_BLUDS
            <h4>$user's  bluds</h4>
            <div class="friends">
_BLUDS;

$result = querySQL("SELECT * FROM friends WHERE user='$user'");

if ($result->rowCount() != 0) {
    while ($row = $result->fetch()) {
        $user = $row['user'];
        echo <<<_BLUD
                <div>
                    <img src='photo_$user.jpg' alt='no_photo.jpg'><a href='profile.php?r=$randstr&view=$user'>$user</a>
                </div>;
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




