<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!--script src="./script.js" defer></script--> 
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Meteo Velletri</title>
</head>

<body onresize="drawChart()">
      
    <!-- sfondi -->

    <video src="./IMG/Nuvole - 8599.mp4" autoplay loop muted></video> 
    <div class="sfondo"></div>

    <!-- tendina laterale (ancora da testase se tenere o meno) -->
    <!--
    <div class="tendalaterale">
        <form action="" id="tendinalat">
            <span class="material-symbols-outlined">
                Monitor_Heart
            </span>
            
            <input id="inputend" type="button" value="" onclick="tenda()" >
        </form>
    </div>
    <div id="tendacharts">
    </div>

    -->

    <!-- barra superiore di navigazione -->


    <nav class="navigazione">
        <a href="#">
            <span class="material-symbols-outlined">
                home
            </span>
        </a> 
        <a href="./additional/chi_siamo.php">Chi siamo</a>
        <a href="./additional/storico.php">Storico</a>
        <?php
            require_once 'functions.php';
            if(!isset($_SESSION['loginUID']) ) echo '<a href="./additional/login.php">Accedi</a>';
            else echo '<a href="./auth/adminpanel.php">Admin Panel</a><a href="auth/logout.php">Logout</a>';
        ?>
    </nav>

    <!-- sezione principale (sotto la zona di navigazione)-->

    <div class="titolo">
        <div class="sottotitolo">
            <h1>Meteo Velletri</h1>
        </div>

        <div class="sottotitolo">
            <h2 id="statoParola"> -- </h2>
            <span class="material-symbols-outlined" id="stato">
                Unknown_Med
            </span>
            <h2 id="temperatura1">--°</h2>
        </div>
        <div class="sottotitolo">
            <h1 id="orologio">-- : -- : --</h1>
            <span class="material-symbols-outlined">
                schedule
            </span>
        </div>
    </div>

    <!-- titolo di benvenuto -->
    
    <h2 class="benvenuto">
        Benvenuto nel nostro sito, qui potrai trovare tutti i dati relativi alle condizioni climatiche della nostra città
    </h2>

    <!-- lista dove vengono disposti i dati -->
    <div class="page" id="zona"> 
        <div class="pacchetto">
            <div class="info" id="infolarghezza1">
                <h3 class="bordo" id="numMisurazione">Misurazione giornaliera n.: --</h3>
                <h3 class="bordo" id="cielo"> -- </h3>
                <h3 class="bordo" id="temperatura2">Temperatura: --°</h3>
                <h3 class="bordo" id="umidità">Umidita: --0%</h3>
                <h3 class="bordo" id="pressione">Pressione: --hPa</h3>
                <h3 class="bordo" id="dirVento">Direzione vento: --</h3>
                <h3 id="velVento">Velocità vento: --Km/h</h3>
            </div>
        </div>
        
        <div id="curve_chart" class="grafico"></div>
        
    </div>
    <?php        
        $date = new DateTime(date('Y/m/d H:i:s'));
        $year = $date->format("Y");
        $res = $db->query("SELECT * FROM `Y$year` where data = (SELECT MAX(data) FROM `Y$year`)")[0];
    ?>
  
    <script type="text/javascript" defer>
        //variabili per il cambio di dati
        const giorniSet = ["Lun","Mar","Mer","Gio","Ven","Sab","Dom"];
        let conta = [];       
        let giorno = <?php 
            $endDate = new DateTime( $db->query("SELECT MAX(data) as data FROM `Y$year`")[0]["data"] );
            echo ( $endDate->format("N")-1);
        ?>; 
        let dataMisurazione = "<?php echo formatDate($res['data']); ?>";        
        let valoreTemperatura = <?php echo $res['temperatura']?>;
        let valoreUmidità = <?php echo $res['umidita']?>; //al valore dell'umidità va dato un numero da 0 a 100 in base alla rispettiva %
        let valorePressione = <?php echo $res['pressione']?>;
        let direzioneVento = '<?php echo $res['direzione-vento']?>';
        let velocitàVento = <?php echo $res['km-h']?>;

        <?php            
            $startDate = (new DateTime($endDate->format("Y-m-d H:i:s")))->modify("-7 day");
            $giorni = [];
            $temperaturaSettimanale = [];
            $umiditaSettimanale = [];
            for($i=6;$i>=0;--$i){
                $currentDay = (new DateTime($endDate->format("Y-m-d H:i:s")))->modify("-$i day");
                $res = $db->query("SELECT AVG(umidita) as umiditaMedia, AVG(temperatura) as temperaturaMedia FROM `Y$year` WHERE data= '".$currentDay->format('Y/m/d H:i:s')."';");
                $giorni[] = $currentDay;
                $temperaturaSettimanale[] = $res[0]['temperaturaMedia'];
                $umiditaSettimanale[] = $res[0]['umiditaMedia'];
            }
            
        ?>
    
        //umidità registrata settimanalmente
        let umiLun = <?php echo (($umiditaSettimanale[0]==null)?0:$umiditaSettimanale[0])?>;
        let umiMar = <?php echo (($umiditaSettimanale[1]==null)?0:$umiditaSettimanale[1])?>;
        let umiMer = <?php echo (($umiditaSettimanale[2]==null)?0:$umiditaSettimanale[2])?>;
        let umiGio = <?php echo (($umiditaSettimanale[3]==null)?0:$umiditaSettimanale[3])?>;
        let umiVen = <?php echo (($umiditaSettimanale[4]==null)?0:$umiditaSettimanale[4])?>;
        let umiSab = <?php echo (($umiditaSettimanale[5]==null)?0:$umiditaSettimanale[5])?>;
        let umiDom = <?php echo (($umiditaSettimanale[6]==null)?0:$umiditaSettimanale[6])?>;

        //temperatura registrata settimanalmente
        let tempLun = <?php echo (($temperaturaSettimanale[0]==null)?0:$temperaturaSettimanale[0])?>;
        let tempMar = <?php echo (($temperaturaSettimanale[1]==null)?0:$temperaturaSettimanale[1])?>;
        let tempMer = <?php echo (($temperaturaSettimanale[2]==null)?0:$temperaturaSettimanale[2])?>;
        let tempGio = <?php echo (($temperaturaSettimanale[3]==null)?0:$temperaturaSettimanale[3])?>;
        let tempVen = <?php echo (($temperaturaSettimanale[4]==null)?0:$temperaturaSettimanale[4])?>;
        let tempSab = <?php echo (($temperaturaSettimanale[5]==null)?0:$temperaturaSettimanale[5])?>;
        let tempDom = <?php echo (($temperaturaSettimanale[6]==null)?0:$temperaturaSettimanale[6])?>;

        //orologio

        window.onload = setInterval(Orologio,1000);
        function addZero(i) {
            if (i < 10)
                i = "0" + i;
            return i;
        }
        function Orologio() {
            var d = new Date();
            var date = d.getDate();
            var ora = addZero(d.getHours());
            var min = addZero(d.getMinutes());
            var sec = addZero(d.getSeconds());
            document.getElementById("orologio").innerHTML=ora+":"+min+":"+sec;

            //controlla l'umidità ogni 20 minuti e cambia informazioni e icona in base ai dati
            if(min == 29){
                cambiaInfo();
                cambiaIcona();
            }else if(min == 59){
                cambiaInfo();
                cambiaIcona();
            }

        }

        let on =0;
        function tenda(){
            if(on === 0){
                document.querySelector("#tendacharts").style.display="flex";
                document.querySelector(".tendalaterale").style.right="75.5%";
                ++on;
            }else{
                document.querySelector("#tendacharts").style.display="none";
                document.querySelector(".tendalaterale").style.right="0";
                --on;
            }
        
        }

        //variabili supporto

        let x = document.getElementById("zona");
        let y = document.getElementById("infolarghezza1");
        let z;
        let k;

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        
        //grafico curvo 
        let f = 1;
        let j = 6;
        for(let i = 0; i < giorniSet.length; ++i){
            if(i == 0){
                conta[i] = giorno;
            }else if(giorno - f >= 0){
                conta[i]= giorno - f;
                ++f
            }else{
                conta[i]= j;
                --j;
            }
        }

        function drawChart() {

            if(x.clientWidth/2 <= 441){
                z = x.clientWidth-25;
                k = y.clientHeight/2;
            }else if(x.clientWidth/2 >= 700){
                z = 700;
                k = y.clientHeight/1.25;
            }else{
                z= x.clientWidth/2;
                k = y.clientHeight/1.25;
            }

            var data = google.visualization.arrayToDataTable([
                ['Settimana', 'Temperatura', 'Umidità'],
                [giorniSet[conta[6]],         tempLun,      umiLun],
                [giorniSet[conta[5]],         tempMar,      umiMar],
                [giorniSet[conta[4]],         tempMer,      umiMer],
                [giorniSet[conta[3]],         tempGio,      umiGio],
                [giorniSet[conta[2]],         tempVen,      umiVen],
                [giorniSet[conta[1]],         tempSab,      umiSab],
                [">"+giorniSet[conta[0]]+"<", tempDom,      umiDom]
            ]);

            var options = {
                title: 'Temperatura e Umidità',
                curveType: 'function',
                legend: { position: 'bottom' },
                width: Math.trunc(z),
                height: Math.trunc(k)
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }

        //per cambiare icona !!! ANCORA DA MODIFICARE, IMPRECISO !!!
        
        function cambiaIcona(){
            statoAtm = document.getElementById(stato.innerHTML);
            let timeNow = new Date();
            timeNow = timeNow.getHours();
        
            if(valoreUmidità >= 90 && valoreTemperatura <= 15){
                document.getElementById("stato").innerHTML = "rainy";
                document.getElementById("statoParola").innerHTML = "Pioggia";
                document.getElementById("cielo").innerHTML = "Condizione atmosferica: Pioggia";
            }else if(valoreUmidità <= 85 && valoreUmidità >= 75 && valoreTemperatura <= 21){
                document.getElementById("stato").innerHTML = ((timeNow > 5  && timeNow < 20)?"cloudy":"Nights_Stay");
                document.getElementById("statoParola").innerHTML = "Nuvoloso";
                document.getElementById("cielo").innerHTML = "Condizione atmosferica: Nuvoloso";
            }else if(valoreUmidità <= 50 ){
                document.getElementById("stato").innerHTML = ((timeNow > 5  && timeNow < 20)?"sunny":"clear_night");
                document.getElementById("statoParola").innerHTML = ((timeNow > 5  && timeNow < 20)?"Soleggiato":"Cielo Limpido");
                document.getElementById("cielo").innerHTML = "Condizione atmosferica: "+((timeNow > 5  && timeNow < 20)?"Soleggiato":"Cielo Limpido");
            }else{
                document.getElementById("stato").innerHTML = ((timeNow > 5  && timeNow < 20)?"partly_cloudy_day":"partly_cloudy_night");
                document.getElementById("statoParola").innerHTML = "Parzialmente nuvoloso";
                document.getElementById("cielo").innerHTML = "Condizione atmosferica: Parzialmente nuvoloso";
            }
        }
        cambiaIcona();


        function cambiaInfo(){
            //document.getElementById("numMisurazione").innerHTML= "Misurazione " + numeroMisurazioni + " - Data: " + dataMisurazione;    
            document.getElementById("numMisurazione").innerHTML= "Ultima rilevazione: " + dataMisurazione;           
            document.getElementById("temperatura1").innerHTML = valoreTemperatura + "°";
            document.getElementById("temperatura2").innerHTML = "Temperatura: " + valoreTemperatura + "°";
            document.getElementById("umidità").innerHTML = "Umidità: " + valoreUmidità + "%";
            document.getElementById("pressione").innerHTML = "Pressione: " + valorePressione + " hPa";
            document.getElementById("dirVento").innerHTML = "Direzione vento: " + direzioneVento;
            document.getElementById("velVento").innerHTML = "Velocità vento: " + velocitàVento + " Km/h"
        }
        cambiaInfo();
    </script>
</body>       
</html>