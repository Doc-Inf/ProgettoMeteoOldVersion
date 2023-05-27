<?php
    session_start();
      
    ini_set ('display_errors', 1);
    ini_set ('display_startup_errors', 1);
    error_reporting (E_ALL);  
    require_once __DIR__ . "/DB/DB.php";
        
    $config = getConfig();
    
    if($config->database->dbLibrary === "pdo"){
        require_once __DIR__ . "/DB/PdoConnection.php";
        $db = new PdoConnection($config->database->hostname,$config->database->username,$config->database->password,$config->database->port,$config->database->dbname,$config->database->dbmsName);
    }else{
        if($config->database->dbLibrary === "mysqli"){
            require_once __DIR__ . "/DB/MySqliConnection.php";
            $db = new MySqliConnection($config->database->hostname,$config->database->username,$config->database->password,$config->database->dbname,$config->database->port);
        }else{
            die("Errore configurazione: la libreria specificata nel file di configurazione, per connettersi al DBMS non è valida");
        }
    }
    
      
    function getConfig(string $PathToConfigJson =__DIR__ . "/config.json") {        
        for($i=0; $i<10; $i++){
            $confData = file_get_contents($PathToConfigJson);
            if(!$confData){
                $PathToConfigJson = "../" . $PathToConfigJson;
            }else{
                break;
            }
        }       
        return json_decode($confData);
    }
  
    function redirect(string $path_to_page) {
        header("Location: $path_to_page");
        die();
    }

    function redirect_post_data(string $path_to_page, array $data) {
        $formName = rand(1, 9999999);
        echo "<form id='$formName' action='$path_to_page' method='post'>";
        foreach ($data as $a => $b) {
            echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
        }
        echo "</form><script type='text/javascript'>document.getElementById('$formName').submit();</script>";
    }

    function extractDate($datetime){
        $date = explode(" ",$datetime)[0];
        $dataInfo = explode("-",$date);
        return $dataInfo[2] . "-" . $dataInfo[1] . "-" . $dataInfo[0];
    }

    function formatDate($date){
        $data = new DateTime($date);
        return $data->format("d-m-Y") . " ore: " . $data->format("H:i:s"); 
    }

    function closeTab(){
        echo "<script>window.close()</script>";
    }

    function getLastDay($db){
        $date = new DateTime(date('Y/m/d H:i:s'));
        $year = $date->format("Y");
        $result = $db->query("SELECT MAX(data) as'ultimoGiornoRilevazioni' FROM y$year");
        return $result[0]['ultimoGiornoRilevazioni'];
    }

    function getData($db, $giorno){
        $date = new DateTime($giorno);
        $year = $date->format("Y");
        $db->beginTransaction();
        $db->dmlCommand("SET @dataOraUltimaRilevazione = '$giorno'");
        $db->dmlCommand("SET @temperaturaUltimaRilevazione = (SELECT temperatura FROM y$year WHERE data=@dataOraUltimaRilevazione)");
        $db->dmlCommand("SET @umiditaUltimaRilevazione = (SELECT umidita FROM y$year WHERE data=@dataOraUltimaRilevazione)");
        $db->dmlCommand("SET @pressioneUltimaRilevazione = (SELECT pressione FROM y$year WHERE data=@dataOraUltimaRilevazione)");
        $db->dmlCommand("SET @direzioneVentoUltimaRilevazione = (SELECT `direzione-vento` FROM y$year WHERE data=@dataOraUltimaRilevazione)");
        $db->dmlCommand("SET @velocitaVentoUltimaRilevazione = (SELECT `km-h` FROM y$year WHERE data=@dataOraUltimaRilevazione)");
        $db->dmlCommand("SET @dataUltimaRilevazione = DATE(@dataOraUltimaRilevazione)");
        $db->dmlCommand("CREATE TEMPORARY TABLE IF NOT EXISTS ultimeMisurazioni SELECT DATE(data) as 'data', TIME(data) as 'ora',temperatura, pressione,umidita,`direzione-vento` as 'direzioneVento',`km-h` as 'velocitaVento' FROM y2023 WHERE DATE(data) = @dataUltimaRilevazione;");
          
        $db->dmlCommand("SET @maxTemperatura = (SELECT MAX(temperatura) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @oraMaxTemperatura = (SELECT ora FROM ultimeMisurazioni WHERE temperatura=@maxTemperatura)");
        $db->dmlCommand("SET @minTemperatura = (SELECT MIN(temperatura) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @oraMinTemperatura = (SELECT ora FROM ultimeMisurazioni WHERE temperatura=@minTemperatura)");
        $db->dmlCommand("SET @mediaTemperatura = (SELECT AVG(temperatura) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @maxUmidita = (SELECT MAX(umidita) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @oraMaxUmidita = (SELECT ora FROM ultimeMisurazioni WHERE umidita=@maxUmidita)");
        $db->dmlCommand("SET @minUmidita = (SELECT MIN(umidita) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @oraMinUmidita = (SELECT ora FROM ultimeMisurazioni WHERE umidita=@minUmidita)");
        $db->dmlCommand("SET @mediaUmidita = (SELECT AVG(umidita) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @maxPressione = (SELECT MAX(pressione) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @oraMaxPressione = (SELECT ora FROM ultimeMisurazioni WHERE pressione=@maxPressione)");
        $db->dmlCommand("SET @minPressione = (SELECT MIN(pressione) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @oraMinPressione = (SELECT ora FROM ultimeMisurazioni WHERE pressione=@minPressione)");
        $db->dmlCommand("SET @mediaPressione = (SELECT AVG(pressione) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @maxVelocitaVento = (SELECT MAX(velocitaVento) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @oraMaxVelocitaVento = (SELECT ora FROM ultimeMisurazioni WHERE velocitaVento=@maxVelocitaVento)");
        $db->dmlCommand("SET @minVelocitaVento = (SELECT MIN(velocitaVento) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @oraMinVelocitaVento = (SELECT ora FROM ultimeMisurazioni WHERE velocitaVento=@minVelocitaVento)");
        $db->dmlCommand("SET @mediaVelocitaVento = (SELECT AVG(velocitaVento) FROM ultimeMisurazioni)");
        $db->dmlCommand("SET @direzioneMaxVento = (SELECT direzioneVento FROM ultimeMisurazioni WHERE velocitaVento=@maxVelocitaVento)");
        $db->dmlCommand("DROP TEMPORARY TABLE IF EXISTS ultimeMisurazioni");
       
        $result =  $db->query("SELECT @dataOraUltimaRilevazione as'dataOraUltimaRilevazione', @temperaturaUltimaRilevazione as 'temperaturaUltimaRilevazione', @umiditaUltimaRilevazione as 'umiditaUltimaRilevazione', @pressioneUltimaRilevazione as 'pressioneUltimaRilevazione', @direzioneVentoUltimaRilevazione as 'direzioneVentoUltimaRilevazione', @velocitaVentoUltimaRilevazione as 'velocitaVentoUltimaRilevazione', @dataUltimaRilevazione as'data', @maxTemperatura as 'maxTemperatura', @oraMaxTemperatura as 'oraMaxTemperatura', @minTemperatura as 'minTemperatura', @oraMinTemperatura as 'oraMinTemperatura', FORMAT(@mediaTemperatura,1) as 'temperaturaMedia', @maxUmidita as 'maxUmidita', @oraMaxUmidita as 'oraMaxUmidita', @minUmidita as 'minUmidita', @oraMinUmidita as 'oraMinUmidita', FORMAT(@mediaUmidita,1) as 'umiditaMedia', @maxPressione as 'maxPressione', @oraMaxPressione as 'oraMaxPressione', @minPressione as 'minPressione', @oraMinPressione as 'oraMinPressione', FORMAT(@mediaPressione,1) as 'pressioneMedia', @maxVelocitaVento as 'maxVelocitaVento', @oraMaxVelocitaVento as 'oraMaxVelocitaVento', @minVelocitaVento as 'minVelocitaVento', @oraMinVelocitaVento as 'oraMinVelocitaVento', FORMAT(@mediaVelocitaVento,1) as `mediaVelocitaVento`, @direzioneMaxVento as 'direzioneMaxVento';");
        $db->commit();
        
        /*
        foreach($result[0] as $key=>$value){
            echo "$key: $value<br>";
        }*/

        return $result[0];
    }
?>