<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="admin.css">
        <title>printDatabase</title>
    </head>

    <body class="log-body">
        
        <!-- sfondi -->

        <video src="../IMG/Nuvole - 8599.mp4" autoplay loop muted></video> 
        <div class="sfondo"></div>

        <?php
            require('../functions.php');

            if(!isset($_SESSION['loginUID'])|| !isset($_POST)) redirect("../auth/adminpanel.php");
        ?>

        <nav class="navigazione">
            <a href="../index.php">
                <span class="material-symbols-outlined">
                    home
                </span>
            </a> 
            <a href="../additional/chi_siamo.php">Chi siamo</a>
            <a href="../additional/storico.php">Storico</a>
            <a href="adminpanel.php">Admin Panel</a>
            <a href="logout.php">Logout</a>
        </nav>

        <div class="log fill-div">
            <h1>Edit stuff</h1>
            <div style="overflow-x: auto;">
                <?php 
                    $data = json_decode(urldecode($_POST['data']));
                ?>
                <form action="executeSQL.php" method="post">
                    <?php
                        if(strcmp($_POST["table"], "login")) {
                            foreach ($data as $key => $value) {
                                echo <<<ITEM
                                
                                ITEM;
                            }
                        } else { //WIP
                            foreach ($data as $key => $value) {
                                echo <<<ITEM
                                
                                ITEM;
                            }
                        }
                    ?>
                </form>
            </div>
        </div>
    </body>
</html>