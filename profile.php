<?php

/**
 * @var string $randstr
 */

$_COOKIE['location'] = 'MATInder: My page';

require_once 'user_info.php';

if (isset($_GET['view']) && $_GET['view'] == $_SESSION['user']) {
    echo "<a href='change_profile.php?r=$randstr'><button>Change profile</button></a>";
} else {
    echo <<<_END
                </div>
            </div>
        </body>
    </html>
    _END;
}


