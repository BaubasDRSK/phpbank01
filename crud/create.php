<?php 
session_start();
if (!isset( $_SESSION['email'])){
    header('Location: http://localhost:8888/phpbank01/login.php');
    die;
}

$accounts = file_get_contents(__DIR__ . '/../accounts.json');
$accounts = $accounts ? json_decode($accounts, 1) : [];
$pids = [];

foreach ($accounts as $acc){
    $pids[] = $acc['pid'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $error1 = "";
    $error2 = "";
    $error3 = "";
    $error4 = "";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    //checking for errors

    if (!preg_match('/^[A-Z,Ą,Č,Ę,Ė,Į,Š,Ų,Ū,Ž][a-z,ą,č,ę,ė,į,š,ų,ū,ž]{2,}$/', $_POST['fname'])){
        $error1 = 1;
    }

    if (!preg_match('/^[A-Z,Ą,Č,Ę,Ė,Į,Š,Ų,Ū,Ž][a-z,ą,č,ę,ė,į,š,ų,ū,ž]{2,}$/', $_POST['lname'])){
        $error2 = 1;
    }

    if (!preg_match('/^(3[0-9]{2}|4[0-9]{2}|6[0-9]{2}|5[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])\d{4}$/', $_POST['pid'])){
        $error3 = 1;
    }
    
    if (in_array($_POST['pid'], $pids)) {
        $error4 = 1;
    }
   
    if ($error1 || $error2 || $error3 || $error4) {
        header("Location: ../addnew.php?e1=$error1&e2=$error2&e3=$error3&e4=$error4&fname=$fname&lname=$lname");
        die;
    }
    
    //adding new account
    $accounts[] = [
        'id' => $_POST['id'],
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'pid' => $_POST['pid'],
        'iban' => $_POST['iban'],
        'balance' => 0,
    ];

    $accounts = json_encode($accounts);
    file_put_contents(__DIR__ . '/../accounts.json', $accounts);
    header('Location: ../list.php');
    die;
    
} else {
    header('Location: ../list.php');
    die;
}
