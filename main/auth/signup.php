<?php

/**
 * @var string $randstr
*/

$_COOKIE['location'] = 'MATInder: My sign up';

require_once '../page/header.php';

if (isset($_SESSION['user'])) {
    destroySession();
}

$error = '<br>';
$user = $pass = "";

if (isset($_POST['user'])) {
    $user = sanitize($_POST['user']);
    $pass = sanitize($_POST['pass']);

    if ($user == "" || $pass == "") {
        $error = 'Not all fields were entered<br>';
    } else {
        $result = querySQL("SELECT * FROM members WHERE user='$user'");

        if ($result->rowCount()) {
            $error = 'That username already exists';
        } else {
            querySQL("INSERT INTO members VALUES('$user', '$pass')");
            die("<div id='signup-text'><h4>Account created</h4>Please Log in.
                 <a href='login.php?r=$randstr'> <button>Log in</button> </a>
                 </div></div></body></html>");
        }
    }
}

echo <<<_SIGN
        <div id="sign-up">
            <p>Create an account on MATInder to get away from Bill Collector.</p>
            <p>Already have an account? Yay! Then click here --> <a href="login.php?r=$randstr"><button>Log in</button></a></p>
            <p>Wanna go home to your mommy? Okay, go ahead, pussy --> <a href="../page/page.php?r=$randstr"><button>Go home, Shawn</button></a></p>
            <form method="post" action="signup.php$randstr">
                <div>$error</div>
                <div id="username">
                    <label>Username: </label>
                    <input type="text" maxlength="20" name="user" onblur="checkUser(this)" onkeydown="checkName(event)">
                </div>
                <div id='used'>&nbsp;</div>
                <div>
                    <label>Password: </label>
                    <input type="password" maxlength="20" name="pass" onkeyup="checkPass(this)">
                </div>
                <div id='weak'>&nbsp;</div>
                <button id="submit" type="submit">Sign up</button>
            </form>
        </div>
    </head>
</body>
_SIGN;