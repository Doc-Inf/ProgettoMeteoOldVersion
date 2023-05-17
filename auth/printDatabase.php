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

        <video src="../img/Nuvole - 8599.mp4" autoplay loop muted></video> 
        <div class="sfondo"></div>

        <?php
            require('../functions.php');

            if($_SESSION['loginUID'] == null||$_GET == null) redirect("../auth/adminpanel.php");
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
            <h1>Printout della tabella "<?php echo $_GET["table"]?>"</h1>
            <div style="overflow-x: auto;">
                <table class="print-table">
                    <tr>
                        <?php
                            $dbname = getConfig()->database->dbname;
                            if(count($db->query("SHOW TABLES where Tables_in_$dbname LIKE '$_GET[table]';")) == 0) {
                                die("<p>Tabella non trovata</p>");
                            }
                            $res = $db->query("SELECT * FROM `".$_GET["table"]."`;");
                            if(count($res)>0){
                                foreach ($res[0] as $key => $value) {
                                    echo "<th>$key</th>";
                                }
                                echo "<th>Modifica</th>";
                                echo "<th>Cancella</th>";
                            }                            

                        ?>
                    </tr>
                        <?php
                            if(count($res)>0){
                                for ($i=0; $i<count($res); ++$i) {
                                    echo "<tr>";
                                    $thisFilePath = __FILE__;
                                    foreach($res[$i] as $key => $value) {
                                        $data = urlencode(json_encode($value));
                                        echo "<td>$value</td>";
                                    }
                                    $id = $res[$i]['id'];
                                    echo <<<ITEM
                                        <form action="edit.php" method="POST">
                                            <input type="hidden" name="table" value="$_GET[table]">
                                            <td>
                                            <button style='color: black;' type="submit" name="data" value="$data">Modifica</button>
                                            </td>
                                        </form>
                                        <form action="executeSQL.php" method="post">
                                            <input type="hidden" name="fromwhere" value="printDatabase.php">
                                            <input type="hidden" name="table" value="$_GET[table]">
                                            <td>
                                                <button style="color: black;" type="submit" name="sql" value="DELETE FROM $_GET[table] WHERE id = $id">Cancella</button>
                                            </td>
                                        </form>
                                    ITEM;
                                    echo "</tr>";
                                }
                            }    
                        ?>
                </table>          
            </div>
        </div>
    </body>

</html>