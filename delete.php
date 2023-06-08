<?php
    session_start();
        
    if (!isset( $_SESSION['email'])){
        header('Location: http://localhost:8888/phpbank01/login.php');
        die;
    }

    if (!$_GET['id']){
        header('Location: http://localhost:8888/phpbank01/list.php');
        die;
    }

    $accounts = file_get_contents(__DIR__ . '/accounts.json');
    $accounts = $accounts ? json_decode($accounts, 1) : [];

    $acc = array_values(array_filter($accounts, fn($a)=>$a['id']===$_GET['id']));
    
    $id = $acc[0]['id'];
    $fname = $acc[0]['fname'];
    $lname = $acc[0]['lname'];
    $pid = $acc[0]['pid'];
    $iban = $acc[0]['iban'];
    $balance = $acc[0]['balance'];
    $balance_curency_tmp = $acc[0]['balance'] / 100;
    $regex = "/(\d)(?=(\d{8})+(?!\d))/";
    $balance_curency = preg_replace($regex, ",", $balance_curency_tmp)." €";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clear bank</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/intl-currency-input.min.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="main-content">
        <div class="login-wrapp">
                <div class="main-form">
                    <?php if($balance) : ?>
                    <form action="./crud/update.php?rp=delete.php" method="post" class="login-form">
                        <h1 class="main-h">Are you shure you want to delete curent account</h1>
                        <p class="info">ID: <?=$id?></p>
                        <p class="info">User: <?=$fname." ".$lname?></p>
                        <p class="info">IBAN: <?=$iban?></p>
                        <p class="info">Actual balance: <?=$balance_curency?></p>
                       
                        <div class="input" style="display:none;">
                            <label for="amount">Amount:</label>
                            <input  type="text" name="amount"  value=<?=($balance/100)?> required>
                        </div>
                        <p class="info">Balance is not empty, do you want to withdraw all??</p>
                        <button class="btn-red" type="submit" name="minus" value=<?=$id?>>Widthraw all</button>
                        <a href="list.php" class="btn-blue" >CANCEL</a>
                    </form>
                    <?php else :?>
                    <form action="./crud/delete.php" method="post" class="login-form">
                        <h1 class="main-h">Are you shure you want to delete curent account</h1>
                        <p class="info">ID: <?=$id?></p>
                        <p class="info">User: <?=$fname." ".$lname?></p>
                        <p class="info">IBAN: <?=$iban?></p>
                        <p class="info">Actual balance: <?=$balance_curency?></p>
                        <p class="info">Balance is 0, you can delete account. Are you sure?</p>
                        <button type="submit" class="btn-red" name="id" value=<?=$id?>>OK DELETE</button>
                        <a href="list.php" class="btn-blue" >CANCEL</a>
                    </form>
                    <?php endif?>
                </div>
            </div>
    </main>
    
</body>
</html>