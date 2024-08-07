<?php

/**
 * @var string $randstr
 * @var string $user
 */

$_COOKIE['location'] = 'MATInder: My profile change';

require_once 'header.php';

require_once 'menu.php';

//$user = $_SESSION['user'];
$result = querySQL('SELECT * FROM profiles WHERE user="$user"');

if (isset($_POST['text'])) {
    $text = sanitize($_POST['text']);
    $text = preg_replace('/\s\s+/', ' ', $text);
    if ($result->rowCount()) {
        querySQL("UPDATE profiles SET text='$text' where user='$user'");
    } else {
        querySQL("INSERT INTO profiles VALUES('$user', '$text')");
    }
} else {
    if ($result->rowCount()) {
        $row = $result->fetch();
        $text = stripslashes($row['text']);
    } else {
        $text = "No info about this blud";
    }
}

if (isset($_FILES['image']['name'])) {
    $source = "$user.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $source);
}

$src = file_exists("$user.jpg") ? "$user.jpg" : "no_photo.jpg";

echo <<<_PROF
                <div class="user-info">
                    <img id="avatar" src="$src" alt="No_photO">
                    <div class="user-text">
                        <h4>$user</h4>
                        <p class="text">$text</p>  
                    </div>
                </div>
_PROF;

echo <<<_FORM
                <form action="change_profile.php" method="POST" enctype='multipart/form-data'>
                    <h5>Enter or edit your details and/or upload an image</h5>
                    <textarea name='text'>$text</textarea><br>
                    Image: <input type='file' name='image' size='14' accept=".gif,.jpg,.jpeg,.png">
                    <input type='submit' value='Save Profile'>
                </form>
_FORM;


echo <<<_END
            </div>
        </div>
    </body>
</html>
_END;

