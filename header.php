<header class="main-header">
        <div class="header-wrapp">
            <div class="header-logo">
                <a href="index.php" class="logo-link"><img src="./img/logo.webp" alt="logo"></a>
            </div>
            <nav class="main-nav">
                <?php if(isset($srchLink)){echo $srchLink;}?>
                <a href="list.php">List view</a>
                <a href="addnew.php">Add new account</a>
                <a href="index.php?exit=1">Logout</a>
            </nav>
        </div>
    </header>