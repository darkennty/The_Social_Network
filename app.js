function checkUser(user) {
    if (user.value == '') {
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