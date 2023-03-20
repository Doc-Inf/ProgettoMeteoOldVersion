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
            require('../functions.php');

            if($_SESSION['loginUID'] == null) redirect("../additional/login.php");
            else{
                $res = query("SELECT * FROM login WHERE id =".$_SESSION["loginUID"])[0];
                
                $id = $res['id'];
                $username = $res["username"];
                $lastLogin = $res["last_access"];
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
            <?php 
                $lastLogin = $_SESSION['lastLogin'];
                if($lastLogin) echo"<a>Ultimo login: $lastLogin</a>";
            ?>

            <form action="insert.php" method="POST" class="insert-form">
                <h2>Inserisci dati nel database</h2>
                <?php
                    if($_POST['insert'] == "done")
                        echo "<p style='color:lime;'>Inserimento completato</p>" 
                ?>
                <input type="number" name="temp" id="temp" placeholder="Temperatura" required> <a>°C</a> <br>
                <input type="number" name="pres" id="pres" placeholder="Pressione" required> <a>hPa</a> <br>
                <input type="number" name="umid" id="umid" placeholder="Umidità" required>  <a>%</a> <br>
                <input type="number" name="velo" id="velo" placeholder="Velocita vento" required> <a>Km/h</a> <br>
                <a>direzione</a><select name="dire" id="dire">
                    <option value="N">Nord</option>
                    <option value="NE">Nord Est</option>
                    <option value="NW">Nord Ovest</option>
                    <option value="E">Est</option>
                    <option value="W">Ovest</option>
                    <option value="S">Sud</option>
                    <option value="SE">Sud Est</option>
                    <option value="SW">Sud Ovest</option>
                </select> <input type="submit" value="Registra">
            </form>

            <form action="newuser.php" method="post" class="insert-form">
                <h2>Crea nuovo account admin</h2>    
                <?php
                    if($_POST['admin'] == "done")
                        echo "<p style='color:lime;'>Admin Creato</p>" 
                ?>
                <input type="text" name="username" id="username" placeholder="username" required> <br>
                <input type="text" name="password" id="password" placeholder="password" required> <br>
                <input type="submit" value="Crea">
            </form>

            <form action="printDatabase.php" method="get" class="insert-form">
                <h2>Printout table</h2>
                <select name="table" id="table">
                    <?php
                        $res = query("SHOW tables;");
                        foreach ($res as $key => $value) {
                            $value = $value['Tables_in_meteo'];
                            echo "<option value='$value'>$value</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Print">
            </form>
        </div>
    </body>
</html>
