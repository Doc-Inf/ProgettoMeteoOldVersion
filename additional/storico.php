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
            if(isset($_SESSION['loginUID'])) echo '<a href="./login.php">Accedi</a>';
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















    /*
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
    */
    ?>

    <div class="grafico2">
        <div id="curve_chart"></div>
    </div>

    <?php
        
        $date = new DateTime(date('Y/m/d H:i:s'));
        $year = $date->format("Y");

        $res = $db->query("SELECT * FROM `Y$year` where data = (SELECT MAX(data) FROM `Y$year`)")[0];
        
        //$res = query("SELECT * FROM `Y$year` where data BETWEEN '".$date->format('Y/m/d')." 00:00:00' and '".$date->format('Y/m/d')." 23:59:59' ORDER BY data desc;")[0];
    ?>

    <script type="text/javascript" defer>
        console.log("on");

        let x = document.getElementById("body");
        let y = document.getElementById("body");
        let z;
        let k;

        
        <?php 
            $endDate = new DateTime( $db->query("SELECT MAX(data) as data FROM `Y$year`")[0]["data"] );
            $startDate = (new DateTime($endDate->format("Y-m-d H:i:s")))->modify("-31 day");
            $temperaturaMensile = [];
            $umiditaMensile = [];
            for($i=30;$i>=0;--$i){
                $currentDay = (new DateTime($endDate->format("Y-m-d H:i:s")))->modify("-$i day");
                $res = $db->query("SELECT AVG(umidita) as umiditaMedia, AVG(temperatura) as temperaturaMedia FROM `Y$year` WHERE data= '".$currentDay->format('Y/m/d H:i:s')."';");
                $temperaturaMensile[] = $res[0]['temperaturaMedia'];
                $umiditaMensile[] = $res[0]['umiditaMedia'];
            }
            
        ?>


        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        
        const giorniSet = ["Lun","Mar","Mer","Gio","Ven","Sab","Dom"];
        let giorno = <?php echo ($date->format("d"));?>;
        let giornoSet = giorniSet[<?php echo ($date->format("N")-1);?>]
        
        function drawChart() {
            console.log(x.clientWidth);
            if(x.clientWidth/2 <= 441){
                z = x.clientWidth*0.90;
                k = y.clientHeight/4;
            }else if(x.clientWidth/2 >= 700){
                z= x.clientWidth/1.5;
                k = y.clientHeight/2;
            }else{
                z= x.clientWidth/1.5;
                k = y.clientHeight/3;
            }

            var data = google.visualization.arrayToDataTable([
                ['Giorno', 'Temperatura', 'Umidità'],
                ["",         <?php echo (($temperaturaMensile[0]==null)?0:$temperaturaMensile[0])?>, <?php echo (($umiditaMensile[0]==null)?0:$umiditaMensile[0]) ?>],
                ["",         <?php echo (($temperaturaMensile[1]==null)?0:$temperaturaMensile[1])?>, <?php echo (($umiditaMensile[1]==null)?0:$umiditaMensile[1]) ?>],
                ["",         <?php echo (($temperaturaMensile[2]==null)?0:$temperaturaMensile[2])?>, <?php echo (($umiditaMensile[2]==null)?0:$umiditaMensile[2]) ?>],
                ["",         <?php echo (($temperaturaMensile[3]==null)?0:$temperaturaMensile[3])?>, <?php echo (($umiditaMensile[3]==null)?0:$umiditaMensile[3]) ?>],
                ["",         <?php echo (($temperaturaMensile[4]==null)?0:$temperaturaMensile[4])?>, <?php echo (($umiditaMensile[4]==null)?0:$umiditaMensile[4]) ?>],
                ["",         <?php echo (($temperaturaMensile[5]==null)?0:$temperaturaMensile[5])?>, <?php echo (($umiditaMensile[5]==null)?0:$umiditaMensile[5]) ?>],
                ["",         <?php echo (($temperaturaMensile[6]==null)?0:$temperaturaMensile[6])?>, <?php echo (($umiditaMensile[6]==null)?0:$umiditaMensile[6]) ?>],
                ["",         <?php echo (($temperaturaMensile[7]==null)?0:$temperaturaMensile[7])?>, <?php echo (($umiditaMensile[7]==null)?0:$umiditaMensile[7]) ?>],
                ["",         <?php echo (($temperaturaMensile[8]==null)?0:$temperaturaMensile[8])?>, <?php echo (($umiditaMensile[8]==null)?0:$umiditaMensile[8]) ?>],
                ["",        <?php echo (($temperaturaMensile[9]==null)?0:$temperaturaMensile[9])?>, <?php echo (($umiditaMensile[9]==null)?0:$umiditaMensile[9]) ?>],
                ["",        <?php echo (($temperaturaMensile[10]==null)?0:$temperaturaMensile[10])?>, <?php echo (($umiditaMensile[10]==null)?0:$umiditaMensile[10]) ?>],
                ["",        <?php echo (($temperaturaMensile[11]==null)?0:$temperaturaMensile[11])?>, <?php echo (($umiditaMensile[11]==null)?0:$umiditaMensile[11]) ?>],
                ["",        <?php echo (($temperaturaMensile[12]==null)?0:$temperaturaMensile[12])?>, <?php echo (($umiditaMensile[12]==null)?0:$umiditaMensile[12]) ?>],
                ["",        <?php echo (($temperaturaMensile[13]==null)?0:$temperaturaMensile[13])?>, <?php echo (($umiditaMensile[13]==null)?0:$umiditaMensile[13]) ?>],
                ["",        <?php echo (($temperaturaMensile[14]==null)?0:$temperaturaMensile[14])?>, <?php echo (($umiditaMensile[14]==null)?0:$umiditaMensile[14]) ?>],
                ["",        <?php echo (($temperaturaMensile[15]==null)?0:$temperaturaMensile[15])?>, <?php echo (($umiditaMensile[15]==null)?0:$umiditaMensile[15]) ?>],
                ["",        <?php echo (($temperaturaMensile[16]==null)?0:$temperaturaMensile[16])?>, <?php echo (($umiditaMensile[16]==null)?0:$umiditaMensile[16]) ?>],
                ["",        <?php echo (($temperaturaMensile[17]==null)?0:$temperaturaMensile[17])?>, <?php echo (($umiditaMensile[17]==null)?0:$umiditaMensile[17]) ?>],
                ["",        <?php echo (($temperaturaMensile[18]==null)?0:$temperaturaMensile[18])?>, <?php echo (($umiditaMensile[18]==null)?0:$umiditaMensile[18]) ?>],
                ["",        <?php echo (($temperaturaMensile[19]==null)?0:$temperaturaMensile[19])?>, <?php echo (($umiditaMensile[19]==null)?0:$umiditaMensile[19]) ?>],
                ["",        <?php echo (($temperaturaMensile[20]==null)?0:$temperaturaMensile[20])?>, <?php echo (($umiditaMensile[20]==null)?0:$umiditaMensile[20]) ?>],
                ["",       <?php echo (($temperaturaMensile[21]==null)?0:$temperaturaMensile[21])?>, <?php echo (($umiditaMensile[21]==null)?0:$umiditaMensile[21]) ?>],
                ["",       <?php echo (($temperaturaMensile[22]==null)?0:$temperaturaMensile[22])?>, <?php echo (($umiditaMensile[22]==null)?0:$umiditaMensile[22]) ?>],
                ["",       <?php echo (($temperaturaMensile[23]==null)?0:$temperaturaMensile[23])?>, <?php echo (($umiditaMensile[23]==null)?0:$umiditaMensile[23]) ?>],
                ["",       <?php echo (($temperaturaMensile[24]==null)?0:$temperaturaMensile[24])?>, <?php echo (($umiditaMensile[24]==null)?0:$umiditaMensile[24]) ?>],
                ["",       <?php echo (($temperaturaMensile[25]==null)?0:$temperaturaMensile[25])?>, <?php echo (($umiditaMensile[25]==null)?0:$umiditaMensile[25]) ?>],
                ["",       <?php echo (($temperaturaMensile[26]==null)?0:$temperaturaMensile[26])?>, <?php echo (($umiditaMensile[26]==null)?0:$umiditaMensile[26]) ?>],
                ["",       <?php echo (($temperaturaMensile[27]==null)?0:$temperaturaMensile[27])?>, <?php echo (($umiditaMensile[27]==null)?0:$umiditaMensile[27]) ?>],
                ["",       <?php echo (($temperaturaMensile[28]==null)?0:$temperaturaMensile[28])?>, <?php echo (($umiditaMensile[28]==null)?0:$umiditaMensile[28]) ?>],
                ["",       <?php echo (($temperaturaMensile[29]==null)?0:$temperaturaMensile[29])?>, <?php echo (($umiditaMensile[29]==null)?0:$umiditaMensile[29]) ?>],
                [giornoSet+" "+giorno,       <?php echo (($temperaturaMensile[30]==null)?0:$temperaturaMensile[30])?>, <?php echo (($umiditaMensile[30]==null)?0:$umiditaMensile[30]) ?>]
            ])

            var options = {
                title: 'Temperatura, Umidità e Pressione Mensile',
                curveType: 'function',
                legend: { position: 'bottom' },
                width: Math.trunc(z),
                height: Math.trunc(k)
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
</body>
</html>