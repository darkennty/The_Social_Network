<?php

/**
 * @var string $text
 * @var string $randstr
 * @var string $user
 */

$_COOKIE['location'] = 'MATInder: My profile change';

require_once 'header.php';

$location = "My profile change";

require_once 'menu.php';

$result = querySQL("SELECT * FROM profiles WHERE user='$user'");
$row = $result->fetch();
$text = $row['text'];

if (isset($_GET['view']) && $_GET['view'] == $_SESSION['user']) {
    echo <<<_FORM
                    <form action="profile.php?r=$randstr&view=$user" method="POST" enctype='multipart/form-data'>
                        <h5>Enter or edit your details and/or upload an image</h5>
                        <div class="about-me">
                            <span>About me: </span>
                            <textarea spellcheck="false" rows="7" cols="50" name='text'>$text</textarea><br>
                        </div>
                        <div>
                            <span>Image: </span><input type='file' name='image' size='14' accept=".gif,.jpg,.jpeg,.png">
                        </div>
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


