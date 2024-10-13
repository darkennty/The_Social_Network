<?php

/**
 * @var string $randstr
 */

$_COOKIE['location'] = 'MATInder: My auth';

require_once('../page/header.php');

if(isset($_SESSION['user'])){
    destroySession();
}

$error = "<br>";
$user = $pass = "";

if (isset($_POST['user'])) {

    $user = sanitize($_POST['user']);
    $pass = sanitize($_POST['pass']);


    if (empty($user) || empty($pass)) {
        $error = "Some of the fields are empty, dummy. Fix it!<br>";
    } else {
        $result = querySQL("SELECT * FROM members WHERE user = '$user'");
        $row = $result->fetch();
        $hash = password_verify($pass, $row['pass']);

        if ($result->rowCount() != 0 && $hash) {
            $_SESSION['user'] = $user;
            die("<div id='login-text'><h4>You goddamn right! Now you are logged in.</h4><p>Join other bluds by <a href='../page/home.php?r=$randstr'>clicking here</a>.</p>
                 </div></div></body></html>");
        } else if ($result->rowCount() != 0) {
            $error = "Are you dumb, stupid, or dumb? Incorrect password, blud. Try again.<br>";
        } else {
            $error = "User does not exist. Maybe you should create an account?<br>";
        }
    }
}

echo <<<_LOG
        <div id="log-in">
            <p>Log in your account and chat with your bluds.</p>
            <p>Don't have an account? Bruh. Click here A\$AP --> <a href="signup.php?r=$randstr"><button>Sign up</button></a></p>
            <p>Wanna go home to your mommy? Okay, go ahead, pussy --> <a href="../page/home.php?r=$randstr"><button>Go home, Shawn</button></a></p>
            <form method="post" action="login.php?r=$randstr">
                <div class="error">$error</div>
                <div id="username" class="field">
                    <label>Username: </label>
                    <input type="text" maxlength="20" name="user" value='$user'>
                </div>
                <div>&nbsp;</div>
                <div class="field">
                    <label>Password: </label>
                    <input type="password" maxlength="20" name="pass" value='$pass'>
                </div>
                <div>&nbsp;</div>
                <div style="height: 27.2px;">&nbsp;</div>
                <div>&nbsp;</div>
                <button id="sumbit" type="submit">Log in</button>
            </form>
        </div>
    </head>
</body>
_LOG;
