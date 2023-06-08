<?php 
    session_start();
    if (!isset( $_SESSION['email'])){
        header('Location: http://localhost:8888/phpbank01/login.php');
        die;
    }
    
    if (!$_POST['id']){
        header('Location: http://localhost:8888/phpbank01/list.php');
        die;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $accounts = file_get_contents(__DIR__ . '/../accounts.json');
        $accounts = $accounts ? json_decode($accounts, 1) : [];
        $id = $_POST['id'];

        $accounts = array_filter($accounts, fn($a)=>$a["id"]!=$id);

        $accounts = json_encode($accounts);
        file_put_contents(__DIR__ . '/../accounts.json', $accounts);
        header('Location: ../list.php');
        die;
    } else {
        header('Location: ../list.php');
        die;
    }