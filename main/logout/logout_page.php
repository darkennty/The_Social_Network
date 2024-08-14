<?php
/**
 * @var string $randstr
*/

$_COOKIE['location'] = 'MATInder: My log out';

require_once '../page/header.php';

require_once '../page/menu.php';

echo <<<_LOGOUT
                <div class="centered-text">
                    <p class="blank-start">Are you sure you want to log out?</p>
                    <div class="choice">
                        <a href="logout.php?r=$randstr"><button>Yurrp</button></a>
                        <a href="../page/menu.php?r=$randstr"><button>Hell naw!</button></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
_LOGOUT;

