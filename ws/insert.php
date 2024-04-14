<?php
    require_once '../functions.php';
    
    $headers = getallheaders();    
    
   
    if( (!isset($headers['Auth'])) || (!isset($_COOKIE['DateTime'])) ){

        if( !isset($headers['Auth']) ){
            echo "Access Denied";
            header( "Response: access forbidden without authentication");
        }else{
            if( (!isset($_COOKIE['DateTime'])) ){
                echo "Access Denied";
                header( "Response: access forbidden without parameters");
                header( "DateTime: " . $_COOKIE['DateTime']);
            }
        }        
         
    }else{
        echo "Richiesta ricevuta...";
        header( "Response: Richiesta accolta, in fase di autenticazione Cookie: " . $_COOKIE['DateTime']);
        $user = $config->database->wsAdmin;
        $password = $config->database->wsAdminPassword;
        $dataAttuale = new DateTime("now",new DateTimeZone("Europe/Rome"));
        $annoAttuale = $dataAttuale->format('Y');     
        $meseAttuale = $dataAttuale->format('n');
        $giornoAttuale = $dataAttuale->format('j');
        $oraAttuale = $dataAttuale->format('H');
                
        $dataTime = DateTime::createFromFormat("d-m-Y G:i:s",$_COOKIE['DateTime']);
        $annoUtente = $dataTime->format('Y');     
        $meseUtente = $dataTime->format('n');
        $giornoUtente = $dataTime->format('j');
        $oraUtente = $dataTime->format('H');
        $minutiUtente = $dataTime->format('i');
        $secondiUtente = $dataTime->format('s');

        if($annoAttuale==$annoUtente && $meseAttuale==$meseUtente && $giornoAttuale==$giornoUtente && $oraAttuale==$oraUtente ){
            
            $testo = "" . $user . $password . $annoUtente . $meseUtente . $giornoUtente . $oraUtente . $minutiUtente . $secondiUtente;
            header( "TestoPrimaHash: " . $testo);
            $binario = hash('sha256', $testo, true);
            $encoded = base64_encode($binario);
            header( "TestoEncoded: " . $encoded);

            if($headers['Auth'] === $encoded){
                    // Takes raw data from the request
                    $data = file_get_contents('php://input');
                    
                    // Converts it into a PHP object
                    $data = json_decode($data, true);
                    
                    function insertData($data){       
                        
                        for($i=0;$i<count($data);++$i){
                            global $db;
                            $dashIndex = strpos($data[$i]['data'],"-");
                            $year = "y" . substr($data[$i]['data'],0,4);
                            $sql = "INSERT INTO $year (data,tempOut,hiTemp,lowTemp,outHum,devPt,windSpeed,windDir,windRun,hiSpeed,hiDir,chillWind,heatIndex,thwIndex,bar,rain,rainRate,heatDD,coolDD,inTemp,inHum,inDew,inHeat,inEMC,inAirDensity,windSamp,windTx,issRecept,arcInt) VALUES ";
                            //logData($data[$i]['data'] . " " . $data[$i]['ora']);
                            $dataOraRilevazione = DateTime::createFromFormat("Y-m-d H:i",$data[$i]['data'] . " " . $data[$i]['ora']);
                            
                            $sql .= "(" . "'" . $dataOraRilevazione->format("Y-m-d H:i") . "',". "'" . $data[$i]['tempOut'] . "',". "'" . $data[$i]['hiTemp'] . "',". "'" . $data[$i]['lowTemp'] . "',". "'" . 
                            $data[$i]['outHum'] . "',". "'" . $data[$i]['devPt'] . "',". "'" . $data[$i]['windSpeed'] . "',". "'" . $data[$i]['windDir'] . "',". "'" . 
                            $data[$i]['windRun'] . "',". "'" . $data[$i]['hiSpeed'] . "',". "'" . $data[$i]['hiDir'] . "',". "'" . $data[$i]['chillWind'] . "',". "'" . $data[$i]['heatIndex'] . "',". "'" . 
                            $data[$i]['thwIndex'] . "',". "'" . $data[$i]['bar'] . "',". "'" . $data[$i]['rain'] . "',". "'" . $data[$i]['rainRate'] . "',". "'" . $data[$i]['heatDD'] . "',". "'" . 
                            $data[$i]['coolDD'] . "',". "'" . $data[$i]['inTemp'] . "',". "'" . $data[$i]['inHum'] . "',". "'" . $data[$i]['inDew'] . "',". "'" . $data[$i]['inHeat'] . "',". "'" . 
                            $data[$i]['inEMC'] . "',". "'" . $data[$i]['inAirDensity'] . "',". "'" . $data[$i]['windSamp'] . "',". "'" . $data[$i]['windTx'] . "',". "'" . $data[$i]['issRecept'] . "',". "'" . 
                            $data[$i]['arcInt'] . "');";
                            logData($sql."\n");
                            $result = $db->dmlCommand($sql);
                            if(!$result){
                                file_put_contents("insertionErrors_$giorno_$mese_$anno.txt",$db->getErrors(),FILE_APPEND);
                            }
                        }
                        
                    }


                    function saveFileData($data){
                        $filename = "dati.txt";
                        if(filesize($filename)>30000000){
                            unlink($filename);
                        }
                        $txt = "";
                        for($i=0;$i<count($data);++$i){
                            $txt.="Rilevazione $i:";
                            foreach($data[$i] as $key=>$value){
                                $txt.="$key=>$value";
                            }
                            $txt.="\n";
                        }    
                        file_put_contents($filename,$txt);
                    }

                    function logData($text){
                        $filename = "log.txt";
                        if(filesize($filename)>30000000){
                            unlink($filename);
                        }
                        file_put_contents($filename,$text,FILE_APPEND);
                    }

                    saveFileData($data);
                    insertData($data);

                    header( "Response: request accepted");   
                    echo "Request accepted";              
                
            }else{            
                header( "Response: access denied, wrong credentials");
                echo "Access Denied";
            }
        }else{
            header( "Response: access denied, wrong credentials");
            echo "Access Denied";
        }
        
    }
   
?>