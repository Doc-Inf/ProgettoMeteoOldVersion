<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="admin.css">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
        <link rel="manifest" href="/site.webmanifest">
        <title>Edit Data</title>
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

        <div  class="log admin-div">
            <h1>Edit stuff</h1>
            <?php 
                //$data = json_decode(urldecode($_POST['data']));
            ?>
            <form action="executeSQL.php" method="post" class="insert-form">
                <?php
                    $data = $db->query("SELECT * FROM " . $_POST['table'] . " WHERE id='" . $_POST['id'] ."'");
                    foreach ($data[0] as $key => $value) {

                        if($_POST['table'] == "login" && $key == "password"){
                            echo <<<ITEM
                            <label for="$key">$key</label>
                            <input type="text" name="$key" id="$key"><br>
                            <label for="$key">Lascia il campo vuoto per non cambiare la password</label>
                            <br>
                            ITEM;
                        } else {
                            echo <<<ITEM
                            <label for="$key">$key</label>
                            <input type="text" name="$key" id="$key" value="$value">
                            <br>
                            ITEM;
                        }
                    }
                    echo "<input type='hidden' name='editStuff' value='edit'>";
                    echo "<input type='hidden' name='table' value='$_POST[table]'>";
                    echo "<input type='submit' value='Modifica'>";
                    echo "</form>";
                ?>
        </div>
    </body>
</html>