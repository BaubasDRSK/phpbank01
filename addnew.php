<?php
    session_start();
    if (!isset( $_SESSION['email'])){
        header('Location: http://localhost:8888/phpbank01/login.php');
        die;
    }

    $fname = $_GET["fname"] ?? "";
    $lname = $_GET["lname"] ?? "";
    
    $err1 = $_GET['e1'] ?? "";
    $err2 = $_GET['e2'] ?? "";
    $err3 = $_GET['e3'] ?? "";
    $err4 = $_GET['e4'] ?? "";

    $err1 = $err1 ? "Firs name is incorrect" : "";
    $err2 = $err2 ? "Last name is incorrect" : "";
    $err3 = $err3 ? "Personal code is incorrect" : "";
    $err4 = $err4 ? "Personal code already exists" : "";

    


    function generateLithuanianIBAN() {
        $countryCode = 'LT';
        $bankAccountNumber = sprintf('%014d', mt_rand(0, 99999999999999));
    
        $iban = $countryCode . '00' . $bankAccountNumber;
    
        // Calculate the checksum digits
        $ibanDigits = str_split($iban);
        $checksum = 0;
        foreach ($ibanDigits as $digit) {
            $checksum = ($checksum * 10 + intval($digit)) % 97;
        }
        $checksumDigits = sprintf('%02d', 98 - $checksum);
    
        // Replace the placeholder checksum with the calculated checksum digits
        $iban = substr_replace($iban, $checksumDigits, 2, 2);
    
        return $iban;
    }
    $id = uniqid("ID", 0);
    $iban = generateLithuanianIBAN();
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
    <main class="main-content">
        <div class="login-wrapp">
                <div class="main-form">
                    <form action="./crud/create.php" method="post" class="login-form">
                        <h1 class="main-h">Please enter new account details</h1>
                        <p class="info">Please enter all essential fields</p>
                        <p class="info"><?= $id?></p>
                        <div style="display:none;">
                            <input type="text" name="id" id="id" value=<?= $id ?> required>
                        </div>

                        <?php if ($err1) : ?>
                            <p style="color:red;"><?= $err1 ?> </p>
                        <?php endif ?>  
                        <div class="input">
                             
                            <label for="fname">First name</label>
                            <img src="./img/person.svg" alt="fname">
                            <input type="text" name="fname" id="fname"  placeholder="Enter your first name" value="<?=$fname?>" required>
                        </div>
                        
                        <?php if ($err2) : ?>
                            <p style="color:red;"><?= $err2 ?> </p>
                        <?php endif ?>  
                        <div class="input">
                            <label for="lname">Last name</label>
                            <img src="./img/person.svg" alt="lname">
                            <input type="text" name="lname" id="lname" placeholder="Enter your last name" value="<?=$lname?>" required>
                        </div>
                        
                        <?php if ($err3) : ?>
                            <p style="color:red;"><?= $err3 ?> </p>
                        <?php endif ?> 
                        <?php if ($err4) : ?>
                            <p style="color:red;"><?= $err4 ?> </p>
                        <?php endif ?> 
                        <div class="input">
                            <label for="pid">Personal ID</label>
                            <img src="./img/pid.svg" alt="pid">
                            <input type="number" name="pid" id="pid" placeholder="Enter your PID" required>
                        </div>

                        <div class="input">
                            <label for="iban">IBAN Account</label>
                            <img src="./img/iban.svg" alt="iban">
                            <input type="text" name="iban" id="iban"   value=<?=$iban?> readonly >
                        </div>
                        
                        
                        <button class="btn-blue" type="submit">Create new account</button>

                    </form>
                </div>
            </div>
    </main>
</body>
</html>