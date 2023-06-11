<?php
session_start();
if (!isset( $_SESSION['email'])){
    header('Location: http://localhost:8888/phpbank01/login.php');
    die;
}
$rp = $_GET['rp'] ?? "edit.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $accounts = file_get_contents(__DIR__ . '/../accounts.json');
    $accounts = $accounts ? json_decode($accounts, 1) : [];
    $amount = $_POST['amount'];

    if (str_contains($amount, "€")){
    $number = str_replace(".", "", $amount);
    $number = str_replace(",", ".", $number);
    } else {
        $number = $amount;
    }
    $value100 = ((float) $number)*100;
    $error = "";

    
    if (isset($_POST['add'])){

        if ($value100 <=0 ){
            header('Location: ../'.$rp.'?id='.$_POST['add']."&e=1");
            die;
        }
        foreach ($accounts as &$a){
            if($a['id'] === $_POST['add']){
            $a['balance'] += $value100;
            }
        }
    $accounts = json_encode($accounts);
    file_put_contents(__DIR__ . '/../accounts.json', $accounts);
    header('Location: ../'.$rp.'?id='.$_POST['add']);
    die;
    }
    

    if (isset($_POST['minus'])){
        if ($value100 <=0 ){
            header('Location: ../'.$rp.'?id='.$_POST['minus']."&e=1");
            die;
        }

        foreach ($accounts as &$a){
            if($a['id'] === $_POST['minus']){
                if ($a['balance'] >= $value100){
                    $a['balance'] -= $value100;    
                } else {
                    header('Location: ../'.$rp.'?id='.$_POST['minus']."&e=2");
                    die;
                }
            }
        }
    $accounts = json_encode($accounts);
    file_put_contents(__DIR__ . '/../accounts.json', $accounts);
    header('Location: ../'.$rp.'?id='.$_POST['minus']);
    die;
    }
    
} else {
    header('Location: ../list.php');
    die;
}
