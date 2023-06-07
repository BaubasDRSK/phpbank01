<?php
session_start();
$exit = $_GET['exit'] ?? "";
if ($exit) {
$_SESSION = [];
}

$userid = $_SESSION['email'] ?? 0;

if ($userid){
    header('Location: http://localhost:8888/phpbank01/list.php');
    die();
}

header('Location: http://localhost:8888/phpbank01/login.php');
    die();