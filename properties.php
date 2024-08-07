<?php
$host = 'localhost';
$data = 'the_social_network';
$user = 'nikita';
$pass = 'Nikita76';
$chrs = 'utf8mb4';
$attr = "mysql:host=$host;dbname=$data;charset=$chrs";
$opts =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int) $e->getCode());
}

function querySQL($query)
{
    global $pdo;
    return $pdo->query($query);
}

function createTable($name, $fields)
{
    querySQL("CREATE TABLE IF NOT EXISTS $name($fields)");
    echo "Table '$name' created or already exists.";
}


function destroySession()
{
    $_SESSION = array();

    if (session_id() != "" || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 2592000, '/');
    }
    session_destroy();
}

function sanitize($str)
{
    global $pdo;
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);

    $result = $pdo->quote($str);
    return str_replace("'", "", $result);
}
