<?php
    require_once '../functions.php';
    
    $headers = getallheaders();

    if(!isset($headers['Auth'])){
        echo "Access Denied";
        header( "Response: access forbidden without authentication");
        /*        
        foreach ($headers as $header => $value) {
            header( "REQUEST$header: $value ");
        }       */
         
    }else{

        $user = $config->database->wsAdmin;
        $password = $config->database->wsAdminPassword;
        $dataTime = new DateTime("now",new DateTimeZone("Europe/Rome"));
        $anno = $dataTime->format('Y');     
        $mese = $dataTime->format('n');
        $giorno = $dataTime->format('j');
        $ora = $dataTime->format('H');
        $testo = "" . $user . $password . $anno . $mese . $giorno . $ora;
        header( "TestoPrimaHash: $testo");
        $binario = hash('sha256', $testo, true);
        $encoded = base64_encode($binario);
        header( "TestoEncoded: $encoded");

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
                        $db->dmlCommand($sql);
                    }
                    
                }


                function saveFileData($data){
                    $txt = "";
                    for($i=0;$i<count($data);++$i){
                        $txt.="Rilevazione $i:";
                        foreach($data[$i] as $key=>$value){
                            $txt.="$key=>$value";
                        }
                        $txt.="\n";
                    }    
                    file_put_contents("dati.txt",$txt);
                }

                function logData($text){
                    file_put_contents("log.txt",$text,FILE_APPEND);
                }

                saveFileData($data);
                insertData($data);

                header( "Response: request accepted");   
                echo "Request accepted";              
            
        }else{
            echo "Access Denied";
            header( "Response: access denied, wrong credentials");
        }
        
    }
   
?>