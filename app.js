function checkUser(user) {
    if (user.value === '') {
        $('#used').html('&nbsp;');
        return;
    }
    $.post
    (
        'check_user.php',
        { user : user.value },
        function(data)
        {
            $('#used').html(data);
        }
    )
}
function checkPass() {
    let str = $('#passwd').val();
    let check_str = $('#rep-passwd').val();
    let flag = true;

    if (str.length < 8 || !(/[A-Z]+/.test(str)) || !(/[a-z]+/.test(str)) || !(/[0-9]+/.test(str))) {
        $('#weak').html('Weak! Bill Collector can easily get it! (Use upper-, lowercase letters and numbers, dummy..)');
        $('#submit').prop('disabled', true);
        flag = false;
    } else {
        $('#weak').html('&nbsp;');
        if (flag) {
            $('#submit').prop('disabled', false);
        }
    }

    if (str !== check_str || str === '') {
        $('#not-match').html('Passwords don\'t match, wtf?! You might wanna check again!');
        $('#submit').prop('disabled', true);
    } else {
        $('#not-match').html('&nbsp;');
        if (flag) {
            $('#submit').prop('disabled', false);
        }
    }
}

function checkName(event) {
    if (event.key === ' ') {
        event.preventDefault();
    }
}

function warning(type, user, friend) {
    let workspace = document.getElementById('workspace');

    let alert = document.createElement('div');
    alert.setAttribute('id', 'alert');

    let btns = document.createElement('div');

    let btnYes = document.createElement('button');
    btnYes.append("Yes");
    btnYes.setAttribute('id', 'btn-yes');

    let btnNo = document.createElement('button');
    btnNo.append("No");
    btnNo.setAttribute('id', 'btn-no');

    btns.append(btnYes, btnNo);

    switch (type) {
        case 'request':
            btnYes.addEventListener('click', function () {
                $.post
                (
                    "..\\friends\\friend_request.php",
                    { user: user,
                        friend: friend },
                    function () {
                        location.reload();
                    }
                )
                document.getElementById('alert').remove();
            })

            alert.insertAdjacentHTML(
                'beforeend',
                `<h5>Are you sure you want to send request to ${friend}?</h5>`
            );
            break;
        case 'admit':
            btnYes.addEventListener('click', function () {
                $.post
                (
                    "..\\friends\\friend_admit.php",
                    { user: user,
                        friend: friend },
                    function () {
                        location.reload();
                    }
                )
                document.getElementById('alert').remove();
            })

            alert.insertAdjacentHTML(
                'beforeend',
                `<h5>Are you sure you want to be bluds with ${friend}?</h5>`
            );
            break;
        case 'unfollow':
            btnYes.addEventListener('click', function () {
                $.post
                (
                    "..\\friends\\friend_delete.php",
                    { user: user,
                        friend: friend },
                    function () {
                        location.reload();
                    }
                )
                document.getElementById('alert').remove();
            })

            alert.insertAdjacentHTML(
                'beforeend',
                `<h5>Are you sure you don't want to be bluds with ${friend}?</h5>`
            );
            break;
        case 'unsend':
            $.post
            (
                "..\\friends\\unsend_request.php",
                { user: user,
                    friend: friend },
                function () {
                    location.reload();
                }
            )
            return;
        default:
    }

    btnNo.addEventListener('click', function() {
        document.getElementById('alert').remove();
    })

    alert.append(btns);
    workspace.append(alert);
}

function checkInput(msg) {
    if (msg.value === '') {
        $('#send-btn').prop('disabled', true);
    } else {
        $('#send-btn').prop('disabled', false);
    }
}

function getContent(user, friend, stamp)
{
    let queryString = {
        'user': user,
        'friend': friend,
        'stamp': stamp,
    };
    function getRequest() {
        $.ajax(
            {
                type: 'GET',
                url: 'getUpdates.php',
                data: queryString,
                success: function(data){
                    if (data === "YES") {
                        location.reload();
                    }

                    setTimeout(
                        getRequest,
                        1000
                    );
                }
            }
        );
    }

    getRequest()
}

function getActionMenu(event) {
    const field = document.querySelector("#chat-field");
    let msg = event.target.closest('.ours');

    if (msg) {
        const x = event.clientX;
        const y = event.clientY;
        msg.insertAdjacentHTML(
            'beforeend',
            `<div class="delete-msg-btn" style="position: absolute; top: ${y}px; left: ${x}px;">
                <button onclick="deleteMessage()">Delete message</button>
            </div>
            `
        )

        msg.classList.add('selected-msg');

        field.removeEventListener("contextmenu", getActionMenu);

        msg.addEventListener("mouseleave", function (event) {
            $('.delete-msg-btn').remove();
            field.addEventListener("contextmenu", getActionMenu);
            msg.classList.remove('selected-msg');
        });

        msg.addEventListener("scroll", function (event) {
            $('.delete-msg-btn').remove();
            field.addEventListener("contextmenu", getActionMenu);
            msg.classList.remove('selected-msg');
        });
    }
}
try {
    const burger = document.querySelector('.burger');
    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
    });
} catch {}

function viewChange() {
    if ($('.password-input').attr('type') == 'password'){
        $('.password-control').addClass('view');
        $('.password-input').attr('type', 'text');
    } else {
        $('.password-control').removeClass('view');
        $('.password-input').attr('type', 'password');
    }
}

function saveValue(e) {
    let friend = e.nextElementSibling.value
    let val = e.value;
    localStorage.setItem(friend, val);
}

function getSavedValue(v) {
    let friend = v.nextElementSibling.value
    let elem = localStorage.getItem(friend)
    if (elem === null) {
        return "";
    }
    v.value = elem
}

function deleteValue(v) {
    localStorage.removeItem(v)
}

