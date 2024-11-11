<?php
$host = 'localhost';
$env = file_get_contents(__DIR__ . '/.env');
$lines = explode("\n",$env);
foreach($lines as $line){
    preg_match("/([^#]+)=(.*)/",$line,$matches);
    if(isset($matches[2])){
        putenv(trim($line));
    }
}
$data = getenv("DATA");
$user = getenv("USER");
$pass = getenv("PASS");
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

function querySQL($query): false|PDOStatement
{
    global $pdo;
    return $pdo->query($query);
}


function destroySession(): void
{
    $_SESSION = array();

    if (session_id() != "" || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 2592000, '/');
    }
    session_destroy();
}

function sanitize($str): array|false|string
{
    global $pdo;
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);

    $result = $pdo->quote($str);
    $result = str_replace("/\n/g", '<br/>', $result);
    return str_replace("'", "", $result);
}
