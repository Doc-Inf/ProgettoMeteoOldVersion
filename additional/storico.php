<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storico</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
</head>
<body onresize="drawChart()" id="body">

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
            if($_SESSION['loginUID'] == null) echo '<a href="./login.php">Accedi</a>';
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
        
            $date = new DateTime($_POST["dataIn"]);
            $year = $date->format("Y");
            
            $res = query("SELECT * FROM `$year` WHERE data BETWEEN '".$date->format('Y/m/d')." 00:00:00' AND '".$date->format('Y/m/d')." 23:59:59' ORDER BY data desc;" );
            $res = $res[0];
            

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

            echo '<div class="page" id="zona"> 
                    <div class="pacchetto">
                        <div class="info" id="infolarghezza1">
                            <h3 class="bordo">Misurazione giornaliera</h3>
                            <h3 class="bordo">'.cielo($res).'</h3>
                            <h3 class="bordo">Gradi:'.$res['temperatura'].'°</h3>
                            <h3 class="bordo">Umidita:'.$res['umidita'].'%</h3>
                            <h3 class="bordo">Pressione: '.$res['pressione'].' hPa</h3>
                            <h3 class="bordo">Direzione vento: '.$res['direzione-vento'].'</h3>
                            <h3 class="bordo">Velocità del vento: '.$res['km-h'].' Km/h</h3>
                            <h3>Misurazione n. '.$res['id'].'<h3>
                        </div>
                        <h6>Data e ora misurazione: '.$res['data'].'</h6>
                    </div>
                </div>';

            $monthData = query("SELECT DISTINCT DATE(data) as t, temperatura, umidita, pressione, `direzione-vento`, `km-h`, id, data from `$year` WHERE MONTH(data)= ".$date->format('m')." AND YEAR(data)=".$year." GROUP BY t ORDER BY data;");
                        
            //print chart
            echo '<div class="chartTest" style="height: 50%; width: 70%; margin:auto;">
                    <div id="curve_chart" class="grafico"></div>
                </div>';
        }
    ?>

    <script>

        let x = document.getElementsByClassName("chartTest");
        let y = x;
        let z;
        let k;

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        
        function drawChart() {
            if(x.clientWidth/2 <= 441){
                z = x.clientWidth-25;
                k = y.clientHeight*6;
            }else if(x.clientWidth/2 >= 700){
                z= x.clientWidth*1;
                k = y.clientHeight*6;
            }else{
                z= x.clientWidth*1;
                k = y.clientHeight*6;
            }

            var data = google.visualization.arrayToDataTable([
                ['Data', 'Temperatura', 'Umidità', 'Pressione', 'Velocita vento'],
                <?php 
                foreach($monthData as $key=>$val) {
                    
                    if($key == sizeof($monthData)-1) 
                        echo "['".$val['t']."', ".$val['temperatura'].", ".$val['umidita'].", ".$val["pressione"].", ".$val['km-h']."]";
                    else 
                        echo "['".$val['t']."', ".$val['temperatura'].", ".$val['umidita'].", ".$val["pressione"].", ".$val['km-h']."],";
                }
                ?>
            ]);


            var options = {
                title: 'Resoconto mensile',
                curveType: 'function',
                legend: { position: 'bottom' },
                width: Math.trunc(z),
                height: Math.trunc(k),
                vAxis: {
                    viewWindowMode: 'explicit',
                    viewWindow: {
                        min: 0
                    }
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
</body>
</html>