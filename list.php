<?php
    session_start();
    if (!isset( $_SESSION['email'])){
        header('Location: http://localhost:8888/phpbank01/login.php');
        die;
    }

    $accounts = file_get_contents(__DIR__ . '/accounts.json');
    $accounts = $accounts ? json_decode($accounts, 1) : [];
    usort($accounts, function($a, $b) {
        return strcmp($a['lname'], $b['lname']);
    });
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clear bank</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="main-content list">
        <div class="main-content-wrapp">         
            <ul class="list-header">
                <li class="user-item">
                            <p>First Name</p>
                            <p>Last Name</p>
                            <p>Personal ID</p>
                            <p>IBAN</p>
                            <p>Balance</p>
                            <p>Actions</p>
                </li>
            </ul>   
            <ul class="user-list">
                <?php foreach ($accounts as $a) :?>
                    <?php 
                        $balance = $a['balance'] / 100;
                        $regex = "/(\d)(?=(\d{3})+(?!\d))/";
                        $balance = preg_replace($regex, ",", $balance)." €";
                    ?>
                    <li class="user-item">
                        <p><?= $a['fname']?></p>
                        <p><?= $a['lname']?></p>
                        <p><?= $a['pid']?></p>
                        <p><?= $a['iban']?></p>
                        <p><?= $balance?></p>
                        <p>EDIT / DELETE</p>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </main>
</body>
</html>