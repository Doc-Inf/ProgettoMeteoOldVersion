<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="./admin.css">
        <title>Admin Panel</title>
    </head>

    <body class="log-body">
        
        <!-- sfondi -->

        <video src="../IMG/Nuvole - 8599.mp4" autoplay loop muted></video> 
        <div class="sfondo"></div>

        <?php
            require_once '../functions.php';
            require_once 'adminFunctions.php';

            if($_SESSION['loginUID'] == null) redirect("../additional/login.php");
            else{
                $res = $db->query("SELECT * FROM login WHERE id =".$_SESSION["loginUID"])[0];
                
                $id = $res['id'];
                $username = $res["username"];
                $lastLogin = $res["last_access"];
                $authlevel = $res["authlevel"];
            } 
            if(isset($_POST['operation'])){
                switch($_POST['operation']){
                    case "insert":{
                        insertRilevazione();
                        break;
                    }
                    case "createUser":{
                        createUser();
                        break;
                    }
                    case "printTable":{
                        break;
                    }
                    case "execDML":
                        break;
                }
            }
        ?>

        <nav class="navigazione">
            <a href="../index.php">
                <span class="material-symbols-outlined">
                    home
                </span>
            </a> 
            <a href="../additional/chi_siamo.php">Chi siamo</a>
            <a href="../additional/storico.php">Storico</a>
            <a href="logout.php">Logout</a>
        </nav>

        <div class="log admin-div">
            <h1>Benvenuto <?php echo $username?></h1>
            <p>Auth level: <?php 
            switch($authlevel) {
                case 0:
                    echo "Super Amministratore";
                    break;
                case 1:
                    echo "Amministratore";
                    break;
                case 2:
                    echo "Operatore";
                    break;
                default:
                    die();
                    break;
            }
            ?></p>
            <?php 
                $lastLogin = $_SESSION['lastLogin'];
                if($lastLogin) echo"<a>Ultimo login: " . formatDate($lastLogin) . "</a>";
            ?>

            <form action="adminpanel.php" method="POST" class="insert-form">
                <h2>Inserisci dati nel database</h2>
                <?php
                if( isset($_POST['insert']) && $_POST['insert'] == "done"){
                    echo "<p style='color:lime;'>Inserimento completato</p>";
                }                                             
                ?>
                <input type="date" name="date" id="date" required><label>Data rilevazione </label><input type="time" name="time" id="time" required><label>Ora </label><br>
                <!--<input type="datetime-local" name="datetime" id="datetime" required><label>Data rilevazione </label><br>-->
                <input type="number" name="temp" id="temp" placeholder="Temperatura" required> <label>°C</label> <br>
                <input type="number" name="pres" id="pres" placeholder="Pressione" required> <label>hPa</label> <br>
                <input type="number" name="umid" id="umid" placeholder="Umidità" required>  <label>%</label> <br>
                <input type="number" name="velo" id="velo" placeholder="Velocita vento" required> <label>Km/h</label> <br>
                <label for="inserisciDirezioneVento">direzione</label>
                <select id="inserisciDirezioneVento" name="dire" id="dire">
                    <option value="N">Nord</option>
                    <option value="NE">Nord Est</option>
                    <option value="NW">Nord Ovest</option>
                    <option value="E">Est</option>
                    <option value="W">Ovest</option>
                    <option value="S">Sud</option>
                    <option value="SE">Sud Est</option>
                    <option value="SW">Sud Ovest</option>
                </select> 
                <input type="hidden" name="operation" value="insert">
                <input type="submit" value="Registra">
            </form>

            <form target="_blank" action="printDatabase.php" method="get" class="insert-form">
                <h2>Printout table</h2>
                <label for="table">Year: </label>
                <select name="table" id="table">
                    <?php
                        $res = $db->query("SHOW tables;");
                        foreach ($res as $key => $value) {
                            $value = $value['Tables_in_meteo'];
                            if($value == "login" && $authlevel >1){
                                continue;
                            }
                            
                            if(strpos($value, 'y') === 0){
                                $value = substr($value, 1, strlen($value));
                                echo "<option value='y$value'>$value</option>";
                            } else {
                                echo "<option value='$value'>$value</option>";
                            }
                        }
                    ?>
                </select>
                <input type="hidden" name="operation" value="printTable">
                <input type="submit" value="Print">
            </form>
            
            <?php if($authlevel < 2):?>
                <form action="adminpanel.php" method="post" class="insert-form">
                    <h2>Crea nuovo account</h2>    
                    <?php
                        if( isset($_POST['admin']) && $_POST['admin'] == "done")
                            echo "<p style='color:lime;'>Utente Creato</p>" 
                    ?> 
                    <input type="text" name="username" id="username" placeholder="username" required> <br>
                    <input type="text" name="password" id="password" placeholder="password" required> <br>
                    <select name="authlevel" id="authlevel">
                        <option value="2">Operatore</option>
                        <?php if($authlevel == 0) echo '<option value="1">Amministratore</option><option value="0">Super Amministratore</option>';?>
                    </select>
                    <input type="hidden" name="operation" value="createUser">
                    <input type="submit" value="Crea">
                </form>

            <?php 
                endif;
                if($authlevel == 0):    
            ?>

                <form target="_blank" action="executeSQL.php" method="POST" class="insert-form">
                    <h2>execute SQL command</h1>
                    <textarea name="sql" cols="40" rows="13" placeholder="Insert SQL query here" required style="color:black; border-radius:.5rem; resize:none;"></textarea>
                    <input type="hidden" name="operation" value="execDML">
                    <input type="submit" value="Execute" style="display:block;">
                </form>
    
            <?php endif;?>
        </div>
    </body>
</html>
