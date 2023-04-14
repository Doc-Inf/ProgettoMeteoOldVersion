<?php
    session_start();
    error_reporting(E_ERROR);    
    
    function getConfig(string $PathToConfigJson ="./config.json") {        
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
    /*
    function query(string $sql, string $dbname = "meteo") {
        $config = getConfig();
        $hostname = $config->database->hostname;
        $username = $config->database->username;
        $password = $config->database->password;
        $port = $config->database->port;

        $conn = new mysqli($hostname, $username, $password, $dbname, $port);
        if($conn->connect_error) die("Connessione fallita ".$conn->connect_error);
        
        $query = $conn->query($sql);
        if($query->num_rows > 0) {
            $res = $query->fetch_all(MYSQLI_ASSOC);
            return $res;
        }
    } */
    
    
    function query(string $sql) { // `
        $config = getConfig();
        $hostname = $config->database->hostname;
        $username = $config->database->username;
        $password = $config->database->password;
        $port = $config->database->port;
        $type = $config->database->type;
        $dbname =  $config->database->dbname;

        try {
            $conn = new PDO("$type:host=$hostname;dbname=$dbname", $username, $password);
        } catch (PDOException $e){
            die("Connessione fallita ".$e->getMessage());
        }

        $query = $conn->query($sql);
        $i=0;
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $res[$i] = $row;
            $i++;
        }
        return $res;
        
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

?>