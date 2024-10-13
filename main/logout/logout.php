<?php

/**
 * @var string $randstr
*/

$_COOKIE['location'] = 'MATInder: My log out';

require_once '../page/header.php';

if (isset($_SESSION['user'])) {
    destroySession();
    $_COOKIE['location'] = '';
}

echo <<<_LOGOUT
        <p id="logout-text">You have been logged out. Now <a href="../page/home.php?r=$randstr">click here</a> to go to the home page.</p>
    </body>
</html> 
_LOGOUT;
