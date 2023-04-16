<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../style.css">
    <title>Login</title>
</head>
<body class="log-body">
    
    <!-- sfondi -->

    <video src="../IMG/Nuvole - 8599.mp4" autoplay loop muted></video>
    <div class="sfondo"></div>

    <!-- barra superiore di navigazione -->

    <nav class="navigazione">
        <a href="../index.php">
            <span class="material-symbols-outlined">
                home
            </span>
        </a> 
        <a href="./chi_siamo.php">Chi siamo</a>
        <a href="./storico.php">Storico</a>
    </nav>

    <!-- punto log -->
    <div class="log">
    <?php
        require("../functions.php");
        if( isset($_SESSION['loginUID']) ) redirect("../index.php");
    ?>
        <h2>Ciao... inserisci le tue credenziali per effettuare l'accesso</h2>
        <form action="../auth/auth.php" method="POST" class="formale">
            <?php if(isset($_POST) && isset($_POST['general'])) echo "<p style='color: red;'>".$_POST['general']."</p>"; ?>
            <label for="user.name">Nome utente</label>
            <?php if(isset($_POST) && isset($_POST['user'])) echo "<p style='color: red;'>".$_POST['user']."</p>"; ?>
            <input type="text" name="username" placeholder="*Nome-utente">
            <label for="user.password">Password utente</label>
            <?php if(isset($_POST) && isset($_POST['pass'])) echo "<p style='color: red;'>".$_POST['pass']."</p>"; ?>
            <input type="password" name="password" placeholder="*Password">
            <input type="submit" value="Accedi">
        </form>
    </div>
    
</body>
</html>