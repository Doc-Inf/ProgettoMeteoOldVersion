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
?>