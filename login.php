<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $users = file_get_contents(__DIR__ . '/users.json');
        $users = json_decode($users, 1);
        $_SESSION['error'] = '';
        foreach($users as $user) {
            if ($user['email'] == $_POST['email'] && $user['psw'] == md5($_POST['psw'])) {
                $_SESSION['email'] = $user['email'];
                header('Location: http://localhost:8888/phpbank01/list.php');
                die;
            }
        }
        $_SESSION['error'] = 'Invalid password or user name';
        header('Location: http://localhost:8888/phpbank01/login.php');
        die;
    }

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }
    else {
        $error = '';
    }
    

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
    <main class="main-content">
        <div class="login-wrapp">
            <div class="login-logo">
                <img src="./img/logo.webp" alt="logo">
            </div>
            <div class="main-form">
                <form action="login.php" method="post" class="login-form">
                    <h1 class="main-h">Welcome back</h1>
                    <p class="info">Enter your credentials to access your account.</p>
                    <?php if ($error) :?>
                        <p class="error"><?= $error ?></p>
                    <?php endif?>    
                    <div class="input">
                        <img src="./img/email.svg" alt="email-icon">
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input">
                        <img src="./img/password.svg" alt="psw-icon">
                        <input type="password" name="psw" id="psw" placeholder="Enter your password" required>
                    </div>
                    <button class="btn-blue" type="submit">Login</button>

                </form>
            </div>
        </div>
    </main>
</body>
</html>