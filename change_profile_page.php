<?php

/**
 * @var string $text
 * @var string $randstr
 * @var string $user
 */

$_COOKIE['location'] = 'MATInder: My profile change';

require_once 'user_info.php';

if (isset($_GET['view']) && $_GET['view'] == $_SESSION['user']) {
    echo <<<_FORM
                    <form action="profile.php?r=$randstr&view=$user" method="POST" enctype='multipart/form-data'>
                        <h5>Enter or edit your details and/or upload an image</h5>
                        <textarea name='text'>$text</textarea><br>
                        Image: <input type='file' name='image' size='14' accept=".gif,.jpg,.jpeg,.png">
                        <input type='submit' value='Save Profile'>
                    </form>
    _FORM;
} else {
    echo <<<_END
                </div>
            </div>
        </body>
    </html>
    _END;
}


