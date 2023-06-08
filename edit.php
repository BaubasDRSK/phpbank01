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

    $error = $_GET['e'] ?? 0;
    if ($error == 1){$error = "Amount is incorerct";}
    if ($error == 2){$error = "Balance is too low";}

    $accounts = file_get_contents(__DIR__ . '/accounts.json');
    $accounts = $accounts ? json_decode($accounts, 1) : [];

    $acc = array_values(array_filter($accounts, fn($a)=>$a['id']===$_GET['id']));
    
    $id = $acc[0]['id'];
    $fname = $acc[0]['fname'];
    $lname = $acc[0]['lname'];
    $pid = $acc[0]['pid'];
    $iban = $acc[0]['iban'];
    $balance = $acc[0]['balance'];
    $balance_curency = $acc[0]['balance'] / 100;
    $regex = "/(\d)(?=(\d{8})+(?!\d))/";
    $balance_curency = preg_replace($regex, ",", $balance_curency)." €";



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
                    <form action="./crud/update.php" method="post" class="login-form">
                        <?php if ($error) :?>
                        <p class="info" style="color:red;"><?=$error?></p>
                        <?php endif?>
                        <h1 class="main-h">You can edit account balance</h1>
                        <p class="info">ID: <?=$id?></p>
                        <p class="info">User: <?=$fname." ".$lname?></p>
                        <p class="info">IBAN: <?=$iban?></p>
                        <p class="info">Actual balance: <?=$balance_curency?></p>
                       
                        <div class="input">
                            <label for="amount">Amount:</label>
                            <input id="input" type="text" name="amount" id="amount"  placeholder="Enter amount" required>
                        </div>
                        <button class="btn-green" type="submit" name="add" value=<?=$id?>>Add</button>
                        <button class="btn-red" type="submit" name="minus" value=<?=$id?>>Minus</button>

                        <a href="list.php" class="btn-blue" >DONE / CANCEL</a>

                    </form>
                </div>
            </div>
    </main>
    <script>
        const input = 'input';
        const options = {
            currency: 'EUR',
            locale: 'de',
            min: 0
            }
        const cinput = new CurrencyInput(input, options);
    </script>
</body>
</html>