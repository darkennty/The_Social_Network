<?php

/**
 * @var string $randstr
 * @var boolean $logged
 * @var string $user
 * @var string $location
 */

if ($location == "&nbsp;" || $location == "") {
    $location = "&nbsp;";
    $close_button = "&nbsp;";
} else {
    $close_button = "<a id='close-btn' href='../page/home.php?r=$randstr'>&#10006;</a>";
}

if ($logged) {
    echo <<<_MENU
        <div id="app-info">
            <div id="burger-menu">
                <input type="checkbox" id="burger-checkbox" class="burger-checkbox">
                <label for="burger-checkbox" class="burger"></label>
                <ul class="menu-list">
                    <li><a href="../profile/profile.php?r=$randstr&view=$user" class="menu-item"><span class="btn-text">My page</span></a>
                    <li><a href="../friends/friends.php?r=$randstr&view=$user" class="menu-item"><span class="btn-text">My bluds</span></a>
                    <li><a href="../subscribers/subscribers.php?r=$randstr&view=$user" class="menu-item"><span class="btn-text">My subway subs</span></a>
                    <li><a href="../members/members.php?r=$randstr" class="menu-item"><span class="btn-text">My members</span></a>
                    <li><a href="../messages/messages.php?r=$randstr" class="menu-item"><span class="btn-text">My messages</span></a>
                    <li><a href="../logout/logout_page.php?r=$randstr" class="menu-item"><span class="btn-text">My log out</span></a>
                </ul>
            </div>
            <p class="hello">What's up, $user</p>
            <p class="loc">$close_button $location</p>
        </div>
        <div id="menu">
            <div id="features">
                <a href="../profile/profile.php?r=$randstr&view=$user"><span class="btn-text">My page</span></a>
                <a href="../friends/friends.php?r=$randstr&view=$user"><span class="btn-text">My bluds</span></a>
                <a href="../subscribers/subscribers.php?r=$randstr&view=$user"><span class="btn-text">My subway subs</span></a>
                <a href="../members/members.php?r=$randstr"><span class="btn-text">My members</span></a>
                <a href="../messages/messages.php?r=$randstr"><span class="btn-text">My messages</span></a>
                <a href="../logout/logout_page.php?r=$randstr"><span class="btn-text">My log out</span></a>
            </div>
            <div id="workspace">
_MENU;
} else {
    echo <<<_AUTH
        <div class="centered-div">
            <p class="welcome">Hello and welcome to MATInder.</p>
            <p class="welcome">To be able to find your blud, you must have an account.</p>
            <div class="btns-auth">
                <a href="../auth/signup.php?r=$randstr"><button class="auth-btn">Sign up</button></a>
                <a href="../auth/login.php?r=$randstr"><button class="auth-btn">Log in</button></a>
                <a href=""><button class="auth-btn">Delete C:/Windows/System32 folder</button></a>
            </div>
        </div>
    </body>
</html>
_AUTH;
    die();
}

if ($_COOKIE['location'] == 'My MATInder') {
    echo <<<_BLANK
                <div class="centered-text">
                    <p style="text-align: center">Dive into your bludlife by choosing options on the sidebar</p>
                </div>
            </div>
        </div>
    </body>
</html>

_BLANK;
}