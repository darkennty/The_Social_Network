<?php

/**
 * @var string $randstr
 * @var boolean $logged
 */

$_COOKIE['location'] = 'MATInder: My members';

$location = "Members of MATInder";

require_once '../page/header.php';

require_once '../page/menu.php';

echo <<<_BLUDS
            <h4>All members of MATInder</h4>
            <div class="members">
_BLUDS;

$result = querySQL("SELECT * FROM members");

while ($row = $result->fetch()) {
    $user = $row['user'];

    if ($_SESSION['user'] == $user) {
        continue;
    } else {
        echo "<a href='../profile/profile.php?r=$randstr&view=$user'>$user</a>";
    }
}

echo <<<_FIN
            </div>
        </div>
    </body>
</html> 
_FIN;




