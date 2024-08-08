<?php

/**
 * @var string $randstr
 * @var string $user
 */

$_COOKIE['location'] = 'MATInder: My page';

require_once 'user_info.php';

if (isset($_GET['view']) && $_GET['view'] == $_SESSION['user']) {
    echo "<a href='change_profile_page.php?r=$randstr&view=$user'><button>Change profile</button></a>";
} else {
    echo <<<_END
                </div>
            </div>
        </body>
    </html>
    _END;
}


