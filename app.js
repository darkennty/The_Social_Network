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
function checkPass(pass) {
    let str = pass.value;
    if (str.length >= 8 && /[A-Z]+/.test(str) && /[a-z]+/.test(str) && /[0-9]+/.test(str)) {
        $('#weak').html('&nbsp;');
        $('#submit').prop('disabled', false);
    } else {
        $('#weak').html('Weak! Bill Collector can easily get it! (Use upper-, lowercase letters and numbers, dummy..)');
        $('#submit').prop('disabled', true);
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
                        console.log('sus');
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