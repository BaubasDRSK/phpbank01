<?php
    session_start();
    if (!isset( $_SESSION['email'])){
        header('Location: http://localhost:8888/phpbank01/login.php');
        die;
    }
    $sorter = $_GET['sort'] ?? "id";
    $sortdir = $_GET['dir'] ?? "0";

    
    $accounts = file_get_contents(__DIR__ . '/accounts.json');
    $accounts = $accounts ? json_decode($accounts, 1) : [];
    
    if ($sortdir == 1){
        usort($accounts, function($a, $b) use($sorter){
            return strnatcmp($a[$sorter], $b[$sorter]);
        });
    }

    if ($sortdir == 2){
        usort($accounts, function($b, $a) use($sorter){
            return strnatcmp($a[$sorter], $b[$sorter]);
        });
    }

    $srchLink = '<a href="#" id="search">Search</a>';
    
    if (isset($_GET['search'])){
        $srchLink = '<a href="list.php">Reset search</a>';
        $search = $_GET["search"];
        $srchStr = $_GET['sStr'];
        $accounts = array_filter($accounts, fn($a)=>str_contains(strtolower($a[$search]), strtolower($srchStr))); //strtolower(string $string): string
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
    <?php include 'header.php'; ?>
    <main class="main-content list">
        <div class="main-content-wrapp">         
            <ul class="list-header">
                <li class="user-item">
                            <p>ID 
                                <?php if($sorter != 'id') : ?>
                                    <a href=<?= "list.php?sort=id&dir=1"?> class="acction">
                                        <img src="./img/no-sort.svg" alt="money" width="20px">
                                    </a>
                                <?php endif ?>

                                <?php if($sorter == 'id' && $sortdir == 0 ) : ?>
                                        <a href=<?= "list.php?sort=id&dir=1"?> class="acction">
                                            <img src="./img/no-sort.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'id' && $sortdir == 1 ) : ?>
                                        <a href=<?= "list.php?sort=id&dir=2"?> class="acction">
                                            <img src="./img/sort-down.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'id' && $sortdir == 2 ) : ?>
                                        <a href=<?= "list.php?sort=id&dir=0"?> class="acction">
                                            <img src="./img/sort-up.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>
                                
                            </p>
                            <p>First Name
                                <?php if($sorter != 'fname') : ?>
                                    <a href=<?= "list.php?sort=fname&dir=1"?> class="acction">
                                        <img src="./img/no-sort.svg" alt="money" width="20px">
                                    </a>
                                <?php endif ?>

                                <?php if($sorter == 'fname' && $sortdir == 0 ) : ?>
                                        <a href=<?= "list.php?sort=fname&dir=1"?> class="acction">
                                            <img src="./img/no-sort.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'fname' && $sortdir == 1 ) : ?>
                                        <a href=<?= "list.php?sort=fname&dir=2"?> class="acction">
                                            <img src="./img/sort-down.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'fname' && $sortdir == 2 ) : ?>
                                        <a href=<?= "list.php?sort=fname&dir=0"?> class="acction">
                                            <img src="./img/sort-up.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>
                            </p>
                            <p>Last Name
                                <?php if($sorter != 'lname') : ?>
                                    <a href=<?= "list.php?sort=lname&dir=1"?> class="acction">
                                        <img src="./img/no-sort.svg" alt="money" width="20px">
                                    </a>
                                <?php endif ?>

                                <?php if($sorter == 'lname' && $sortdir == 0 ) : ?>
                                        <a href=<?= "list.php?sort=lname&dir=1"?> class="acction">
                                            <img src="./img/no-sort.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'lname' && $sortdir == 1 ) : ?>
                                        <a href=<?= "list.php?sort=lname&dir=2"?> class="acction">
                                            <img src="./img/sort-down.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'lname' && $sortdir == 2 ) : ?>
                                        <a href=<?= "list.php?sort=lname&dir=0"?> class="acction">
                                            <img src="./img/sort-up.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                            </p>
                            <p>Personal ID
                                <?php if($sorter != 'pid') : ?>
                                    <a href=<?= "list.php?sort=pid&dir=1"?> class="acction">
                                        <img src="./img/no-sort.svg" alt="money" width="20px">
                                    </a>
                                <?php endif ?>

                                <?php if($sorter == 'pid' && $sortdir == 0 ) : ?>
                                        <a href=<?= "list.php?sort=pid&dir=1"?> class="acction">
                                            <img src="./img/no-sort.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'pid' && $sortdir == 1 ) : ?>
                                        <a href=<?= "list.php?sort=pid&dir=2"?> class="acction">
                                            <img src="./img/sort-down.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'pid' && $sortdir == 2 ) : ?>
                                        <a href=<?= "list.php?sort=pid&dir=0"?> class="acction">
                                            <img src="./img/sort-up.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                            </p>
                            <p>IBAN
                                <?php if($sorter != 'iban') : ?>
                                    <a href=<?= "list.php?sort=iban&dir=1"?> class="acction">
                                        <img src="./img/no-sort.svg" alt="money" width="20px">
                                    </a>
                                <?php endif ?>

                                <?php if($sorter == 'iban' && $sortdir == 0 ) : ?>
                                        <a href=<?= "list.php?sort=iban&dir=1"?> class="acction">
                                            <img src="./img/no-sort.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'iban' && $sortdir == 1 ) : ?>
                                        <a href=<?= "list.php?sort=iban&dir=2"?> class="acction">
                                            <img src="./img/sort-down.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'iban' && $sortdir == 2 ) : ?>
                                        <a href=<?= "list.php?sort=iban&dir=0"?> class="acction">
                                            <img src="./img/sort-up.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>
                            </p>
                            <p>Balance
                                <?php if($sorter != 'balance') : ?>
                                    <a href=<?= "list.php?sort=balance&dir=1"?> class="acction">
                                        <img src="./img/no-sort.svg" alt="money" width="20px">
                                    </a>
                                <?php endif ?>

                                <?php if($sorter == 'balance' && $sortdir == 0 ) : ?>
                                        <a href=<?= "list.php?sort=balance&dir=1"?> class="acction">
                                            <img src="./img/no-sort.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'balance' && $sortdir == 1 ) : ?>
                                        <a href=<?= "list.php?sort=balance&dir=2"?> class="acction">
                                            <img src="./img/sort-down.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                                <?php if($sorter == 'balance' && $sortdir == 2 ) : ?>
                                        <a href=<?= "list.php?sort=balance&dir=0"?> class="acction">
                                            <img src="./img/sort-up.svg" alt="money" width="20px">
                                        </a>
                                <?php endif ?>

                            </p>
                            <p>Actions</p>
                </li>
            </ul>   
            <ul class="user-list">
                <?php foreach ($accounts as $a) :?>
                    <?php 
                        $balance = $a['balance'] / 100;
                        $regex = "/(\d)(?=(\d{8})+(?!\d))/";
                        $balance = preg_replace($regex, ",", $balance)." €";
                    ?>
                    <li class="user-item">
                        <p><?= $a['id']?></p>
                        <p><?= $a['fname']?></p>
                        <p><?= $a['lname']?></p>
                        <p><?= $a['pid']?></p>
                        <p><?= $a['iban']?></p>
                        <p><?= $balance?></p>
                        <p> 
                            <a href=<?= "edit.php?id=".$a['id']?> class="acction">
                                <img src="./img/money.svg" alt="money" width="30px">                            
                            </a>
                            <span>   </span>  
                            <a href=<?= "delete.php?id=".$a['id']?> class="acction">
                                <img src="./img/delete.svg" alt="delete" width="30px">
                            </a>
                        </p>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <dialog id="modal">
            <form action="./list.php" method="get">
                    <h2>Select field to search in :</h2>
                    <div>
                        <input type="radio" id="searchChoice1" name="search" value="lname" checked/>
                        <label for="searchChoice1">Last Name</label>
                    </div>

                    <div>
                        <input type="radio" id="searchChoice2" name="search" value="pid" />
                        <label for="searchChoice2">Personal ID</label>
                    </div>

                    <div>
                        <input type="radio" id="searchChoice3" name="search" value="iban" />
                        <label for="searchChoice3">IBAN</label>
                    </div>

                    <div>
                        <label for="searchString">Search for:</label>
                        <input type="text" id="searchString" name="sStr" required/>
                    </div>
                <button type="submit">SEARCH</button>
            </form>
        </dialog>
    </main>
    <script>
        function modalOpen(){
            modal= document.getElementById('modal');
            modal.show();
        }
        const linkas = document.getElementById('search');
        linkas.addEventListener("click", modalOpen);
    </script>
</body>
</html>