<?php

/**
 * @var string $randstr
 * @var string $user
 */

$_COOKIE['location'] = 'MATInder: My page';

require_once 'user_info.php';

$text = "";

if (isset($_GET['view'])) {
    if ($_GET['view'] == $_SESSION['user']) {
        echo "<a href='change_profile_page.php?r=$randstr&view=$user'><button>Change profile</button></a>";
    } else {
        $friend = $_GET['view'];
        $result = querySQL("SELECT * FROM friends WHERE (user='$user' AND friend='$friend') OR (user='$friend' AND friend='$user')");

        if ($result->rowCount() != 0) {
            $text = "<p>You are bluds with $friend. Very nice!</p><br>";
            $text .= "<button onclick='warning(`unfollow`, `$user`, `$friend`)'>Stop being bluds</button>";
        } else {
            $result = querySQL("SELECT * FROM friend_requests WHERE sender='$user' AND receiver='$friend'");

            if ($result->rowCount() != 0) {
                $text = "<p>Request sent.</p>";
                $text .= "<button onclick='warning(`unsend`, `$user`, `$friend`)'>Unsend request</button>";
            } else {
                $result = querySQL("SELECT * FROM friend_requests WHERE sender='$friend' AND receiver='$user'");
                if ($result->rowCount() != 0) {
                    $text = "<button onclick='warning(`admit`, `$user`, `$friend`)'>Admit the request to be bluds</button>";
//                    $text = "<button onclick='warning(`deny`, `$user`, `$friend`)'>Deny the request to be bluds</button>";
                } else {
                    $text = "<button onclick='warning(`request`, `$user`, `$friend`)'>Send request to be bluds</button>";
                }
            }
        }
    }
}
echo <<<_END
                $text
            </div>
        </div>
    </body>
</html>
_END;