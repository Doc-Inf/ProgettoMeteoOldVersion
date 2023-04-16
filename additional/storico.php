<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storico</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>

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
        <?php
            require('../functions.php');
            if( !isset($_SESSION['loginUID']) ) echo '<a href="./login.php">Accedi</a>';
            else echo '<a href="../auth/adminpanel.php">Admin Panel</a><a href="../auth/logout.php">Logout</a>';
        ?>
    </nav>

    <!-- zona di ricerca -->

    <div id="spazio"></div>

    <div class="page">
        <div class="zonaricerca">
            <h2>
                Benvenuto, inserisci la data della misurazione che vuoi controllare
            </h2>

            <form action="storico.php" method="post" class="formale">
                <label for="Data">Data</label>
                <input type="date" name="dataIn">
                <button type="submit" id="rec">
                    <h2>cerca</h2> 
                    <span class="material-symbols-outlined">
                        search
                    </span>
                </button>
            </form>
            
        </div>
    </div>
    <?php
        if($_POST) {
        
            function cielo($res) { // $res MUST be an array containing numeric values labeled as "umidita" and "temperatura"
                if($res["umidita"] >= 90 && $res["temperatura"] <= 15) {
                    return "Pioggia";
                } else if($res["umidita"] <= 85 && $res["umidita"] >= 75 && $res["temperatura"] <= 21) {
                    return "Cielo Nuvoloso";
                } else if($res["umidita"] <= 50 ) {
                    return "Cielo Soleggiato";
                } else {
                    return "Cielo Parzialmente nuvoloso";
                }
            }

            $date = new DateTime($_POST["dataIn"]);
            $year = $date->format("Y");
            
            $date->setTime(23,9,4); // set time at last measure for day Hour:minute:second 
            $sql = "SELECT * FROM `Y$year` WHERE DATE(data)='".$date->format('Y-m-d')."';";           
            $res = $db->query($sql);            
            

            if( $res && isset($res[0]['data'])) {     
                $res = $res[0];
                echo '<div class="page" id="zona"> 
                        <div class="pacchetto">
                            <div class="info" id="infolarghezza1">
                                <h3 class="bordo">Misurazione giornaliera</h3>
                                <h3 class="bordo">Data: '. extractDate($res['data']) .'</h3>
                                <h3 class="bordo">'.cielo($res).'</h3>
                                <h3 class="bordo">Gradi: '.$res['temperatura'].'°</h3>
                                <h3 class="bordo">Umidita: '.$res['umidita'].'%</h3>
                                <h3 class="bordo">Pressione: '.$res['pressione'].' hPa</h3>
                                <h3 class="bordo">Direzione vento: '.$res['direzione-vento'].'</h3>
                                <h3 class="bordo">Velocità del vento: '.$res['km-h'].' Km/h</h3>
                                <h3>Misurazione n. '.$res['id'].'<h3>                            
                            </div>                        
                        </div>
                    </div>';
            }else{
                echo '<div class="page" id="zona"> 
                        <div class="pacchetto">
                            <div class="info" id="infolarghezza1">
                                <h3 class="bordo">Misurazione giornaliera non disponibile</h3>
                                <h3 class="bordo">Data: ' . $date->format("d-m-Y") . '</h3>
                                <h3 class="bordo">Gradi: NA</h3>
                                <h3 class="bordo">Umidita: NA</h3>
                                <h3 class="bordo">Pressione: NA</h3>
                                <h3 class="bordo">Direzione vento: NA</h3>
                                <h3 class="bordo">Velocità del vento: NA</h3>
                                <h3>Misurazione n. NA<h3>                            
                            </div>                        
                        </div>
                    </div>';
            }
        }

            
    ?>

</body>
</html>