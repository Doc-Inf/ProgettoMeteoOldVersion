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
        <a href="../index.php">
            <span class="material-symbols-outlined">
                home
            </span>
        </a> 
        <a href="./additional/chi_siamo.php">Chi siamo</a>
        <a href="./additional/storico.php">Storico</a>
        <?php
            require('functions.php');
            if($_SESSION['loginUID'] == null) echo '<a href="./additional/login.php">Accedi</a>';
            else echo '<a href="./auth/adminpanel.php">Admin Panel</a><a href="auth/logout.php">Logout</a>';
        ?>
    </nav>

    <!-- sezione principale (sotto la zona di navigazione)-->

    <div class="titolo">
        <div class="sottotitolo">
            <h1>Meteo Velletri</h1>
        </div>

        <div>
            <h2 id="statoParola"> --- </h2>
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

        $res = query("SELECT * FROM `$year` where data BETWEEN '".$date->format('Y/m/d')." 00:00:00' and '".$date->format('Y/m/d')." 23:59:59' ORDER BY data desc;")[0];
    ?>
    <script type="text/javascript" defer>
        //variabili per il cambio di dati
        const giorniSet = ["Lun","Mar","Mer","Gio","Ven","Sab","Dom"];
        let conta = [];
        let giorno = <?php echo ($date->format("N")-1);?>;
        let numeroMiusrazioni = <?php echo $res['id']?>;
        let valoreTemperatura = <?php echo $res['temperatura']?>;
        let valoreUmidità = <?php echo $res['umidita']?>; //al valore dell'umidità va dato un numero da 0 a 100 in base alla rispettiva %
        let valorePressione = <?php echo $res['pressione']?>;
        let direzioneVento = '<?php echo $res['direzione-vento']?>';
        let velocitàVento = <?php echo $res['km-h']?>;
        <?php 
            $date = new DateTime(date('Y/m/d H:i:s'));
            $date->setTime(23,9,4);
            
            $day1 = new DateTime(date('Y/m/d H:i:s'));
            $day1->modify("-7 day");
            $day1->setTime(23,9,4);
            /*
            for($i =$day1->format("N"); $i>($day1->format("N")); $i--) {
                $day1->modify("-1 day");
            }   
            */
            $res = query("SELECT umidita, temperatura FROM `$year` WHERE data BETWEEN '".$day1->format('Y/m/d H:i:s')."' and '".$date->format('Y/m/d H:i:s')."';");
        ?>
        //umidità registrata settimanalmente
        let umiLun = <?php echo (($res[0]['umidita']==null)?0:$res[0]['umidita'])?>;
        let umiMar = <?php echo (($res[1]['umidita']==null)?0:$res[1]['umidita'])?>;
        let umiMer = <?php echo (($res[2]['umidita']==null)?0:$res[2]['umidita'])?>;
        let umiGio = <?php echo (($res[3]['umidita']==null)?0:$res[3]['umidita'])?>;
        let umiVen = <?php echo (($res[4]['umidita']==null)?0:$res[4]['umidita'])?>;
        let umiSab = <?php echo (($res[5]['umidita']==null)?0:$res[5]['umidita'])?>;
        let umiDom = <?php echo (($res[6]['umidita']==null)?0:$res[6]['umidita'])?>;

        //temperatura registrata settimanalmente
        let tempLun = <?php echo (($res[0]['temperatura']==null)?0:$res[0]['temperatura'])?>;
        let tempMar = <?php echo (($res[1]['temperatura']==null)?0:$res[1]['temperatura'])?>;
        let tempMer = <?php echo (($res[2]['temperatura']==null)?0:$res[2]['temperatura'])?>;
        let tempGio = <?php echo (($res[3]['temperatura']==null)?0:$res[3]['temperatura'])?>;
        let tempVen = <?php echo (($res[4]['temperatura']==null)?0:$res[4]['temperatura'])?>;
        let tempSab = <?php echo (($res[5]['temperatura']==null)?0:$res[5]['temperatura'])?>;
        let tempDom = <?php echo (($res[6]['temperatura']==null)?0:$res[6]['temperatura'])?>;

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
            [">"+giorniSet[conta[0]]+"<",         tempDom,      umiDom]
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
            document.getElementById("numMisurazione").innerHTML= "Misurazione n.: " + numeroMiusrazioni;            
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