<?php

/**
 * @var string $user
 * @var string $randstr
 */

$_COOKIE['location'] = 'MATInder: My messages';

require_once '../page/header.php';

$location = "$user's bomboclat chats";

require_once '../page/body.php';

$user_result = querySQL("SELECT * FROM members WHERE user='$user'");

if ($user_result->rowCount() != 0) {
    echo "<div id='messages'><div id='chatters'>";

    $friend_result = querySQL("SELECT * FROM friends WHERE user='$user' OR friend='$user'");

    while ($row = $friend_result->fetch()) {
        $friend = $row['user'] == $user ? $row['friend'] : $row['user'];
        $src = file_exists("../../avatars/photo_$friend.jpg") ? "../../avatars/photo_$friend.jpg" : "../../images/no_photo.jpg";

        if (isset($_GET['chatter']) && $_GET['chatter'] == $friend) {
            $dis = 'disabled="true"';
        } else {
            $dis = "";
        }

        echo <<<_PROF
                                <div class="chatter">
                                    <img class="chatter_img" src='$src' alt='No_photO'><a class="chatter_link" href="messages.php?chatter=$friend&r=$randstr"><button style="width: 100%" $dis onclick="">$friend</button></a>
                                </div>
        _PROF;
    }
    echo <<<_FIELD
                            </div>
                            <div id="chat">
    _FIELD;

    if (isset($_GET['chatter'])) {
        $friend = sanitize($_GET['chatter']);

        $friend_result = querySQL("SELECT * FROM members WHERE user='$friend'");

        if ($friend_result->rowCount() == 0) {
            die("<div class='centered-text'><p style='text-align: center'>No such blud in our social network, sorry!</p><div>");
        }

        $friend_result = querySQL("SELECT * FROM friends WHERE (user='$user' AND friend='$friend') OR (friend='$user' AND user='$friend')");

        if ($friend_result->rowCount() == 0) {
            die("<div class='centered-text'><p style='text-align: center'>This user is not you blud... You can't chat with him, dumbo!</p><div>");
        }

        if (isset($_POST['message'])) {
            $message = sanitize($_POST['message']);
            date_default_timezone_set('Europe/Moscow');
            $date = date("Y-m-d H:i:s");
            $result = querySQL("INSERT INTO messages (author, recipent, date, message) VALUES ('$user', '$friend', '$date', '$message')");
            exit("<meta http-equiv='refresh' content='0; url= messages.php?chatter=$friend&r=$randstr'>");
        }

        echo <<< _INFO
            <div class='who'>
                <p style="text-align: center">$friend</p>
            </div>
            <div id="chat-field">
        _INFO;

        $result = querySQL("SELECT * FROM messages WHERE (author='$user' AND recipent='$friend') OR (author='$friend' AND recipent='$user')");
        $rowCount = $result->rowCount();

        if ($rowCount != 0) {
            while ($row = $result->fetch()) {
                if ($row['author'] == $user) {
                    $author = 'ours';
                    $align = 'flex-end';
                    $msg_color = 'dodgerblue';
                    $arrow = "border-bottom-right-radius: 0";
                } else {
                    $author = 'theirs';
                    $align = 'flex-start';
                    $msg_color = '#cccccc';
                    $arrow = "border-bottom-left-radius: 0";
                }
                echo <<<_MSG
                <div style="width: 100%; display: flex; justify-content: $align">
                    <div class='message $author' style="min-width: 30%; text-align: left; background-color: $msg_color; $arrow; padding: 0 5px; margin: 2px 0">
                        <p>{$row['message']}</p>
                        <input class="msg-date" type="hidden" value="{$row['date']}">
                        <input class="msg-id" type="hidden" value="{$row['id']}">
                    </div>
                </div>
                _MSG;
            }
            echo <<<_SCROLL
                <script>
                    const field = document.querySelector("#chat-field");
                    field.addEventListener("contextmenu", getActionMenu);
                    field.addEventListener("contextmenu", function(event) {event.preventDefault()});
                    
                    function scrollToBottom() {
                        const container = document.getElementById('chat-field');
                        container.scrollTop = container.scrollHeight;
                    }
                    
                    function deleteMessage() {
                        const id = document.querySelector('.selected-msg').lastElementChild.previousElementSibling.value;
                        console.log(id)
                        $.post
                        (
                            "deleteMessage.php",
                            {
                                id: id,
                                user : '$_SESSION[user]'
                            },
                            function () {
                                location.reload();
                            }
                        )
                    }
                    
                    window.onload = scrollToBottom;
                    getContent('$user', '$friend', '$rowCount');
                </script>
            </div>
            _SCROLL;
        } else {
            echo <<<_NOCHAT
            <div class='centered-text'>
                <p>No messages found. Start chatting with blud by sending any message.</p>
            </div>
            <script>
                getContent('$user', '$friend', '$rowCount');
            </script>
        </div>
        _NOCHAT;
        }

        echo <<< _SEND
        <div class='send-section'>
            <form method="post" action="messages.php?chatter=$friend&r=$randstr">
                <div id="message-field">
                    <input type="text" name="message" autocomplete="off" autofocus placeholder="Send a message to your blud..." onfocus="getSavedValue(this); checkInput(this);" onkeyup="checkInput(this); saveValue(this)">
                    <input type="hidden" name="friend" value="$friend">
                    <input type="hidden" name="user" value="$user">
                </div>
                <button id="send-btn" type="submit" disabled="disabled" onclick="deleteValue('$friend');">Send</button>
            </form>
        </div>
        _SEND;
    }
} else {
    die("<div class='centered-text'><p>No such blud in our social network! Sorry.</p></div>");
}