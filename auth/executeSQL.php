<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="admin.css">
        <title>Execute DML</title>
    </head>

    <body class="log-body">
        
        <!-- sfondi -->

        <video src="../IMG/Nuvole - 8599.mp4" autoplay loop muted></video> 
        <div class="sfondo"></div>

        <?php
            require('../functions.php');

            if(!isset($_SESSION['loginUID']) || !isset($_POST)) redirect("../auth/adminpanel.php");

            if(!isset($_POST['sql'])) die("no query");
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
            <h1>Risultato della query</h1>
            <?php
                echo $_POST['sql']."<br>";
                $res = $db->getConnection()->query($_POST['sql']);
                if(!$res)
                    die("Error Executing query. Please close this page and try again");

                $res = $res->fetchAll();
                if(!array_key_exists(0, $res)):
                    die("Operation successful");
                else:
            ?>
            <div style="overflow-x: auto;">
                <table class="print-table">
                    <tr>
                        <?php
                            foreach ($res[0] as $key => $value) {
                                echo "<th>$key</th>";
                            }
                        ?>
                    </tr>
                    <?php
                        foreach ($res as $key => $value) {
                            echo "<tr>";
                            foreach($value as $kkey => $vvalue) {
                                echo "<td>$vvalue</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                </table>
            </div>
            <?php endif;?>
        </div>
    </body>
</html>
