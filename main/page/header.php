<?php
session_start();

require_once '../properties.php';

$randstr = substr(md5(rand()), 0, 7);
$loc = "MATInder: My guest";
$logged = false;

if (isset($_SESSION['user'])) {
    $logged = true;
    $user = $_SESSION['user'];
}

if (isset($_COOKIE['location'])) {
    $loc = $_COOKIE['location'];
}

echo <<<_INIT
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='../../style.css' type='text/css'>
        <script src='../../jquery-2.2.4.min.js'></script>
        <script src="../../app.js"></script>
        <title>$loc</title>
    </head>
    <body>
        <div id="header">
            <a href="../page/home.php?r=$randstr"><img id="logo-pic" src="../../images/logo.png" alt=""><span class="brand-name">nder. Find your blud.</span></a>
        </div>
_INIT;
