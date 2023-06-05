<?php
session_start();
$userid = $_SESSION['userid'] ?? 0;

if ($userid){
    header('Location: http://localhost:8888/phpbank01/list.php');
    die();
}

header('Location: http://localhost:8888/phpbank01/login.php');
    die();