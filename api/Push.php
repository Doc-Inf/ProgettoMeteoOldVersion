<?php

    require_once "../functions.php";
    
    $user = $_SERVER["PHP_AUTH_USER"];
    $pass = $_SERVER["PHP_AUTH_PW"];

    if($config->database->dbLibrary === "pdo") {
        $arr = [$user, hash("sha256", $pass)];
        $arr2 = [];
    } else if($config->database->dbLibrary === "mysqli") {
        $arr = ["ss", $user, hash("sha256", $pass)];
        $arr2 = ["sidisi"];
    } else {
        header("Invalid library ".$config->database->dbLibrary.". Check config file in server.");
        die("{\"Response\": \"Invalid library ".$config->database->dbLibrary."\"}");
    }

    $auth = @$db->query("SELECT * FROM login WHERE username = ? and password = ?;", $arr);
    
    if(!isset($auth[0])) {
        header("WWW-Authenticate: Basic realm=\"My Realm\"");
        header("HTTP/1.0 401 Unauthorized");
        die("{\"Response\": \"Unauthorized\"}");
    }
    $auth = $auth[0];
    $keys = ["datetime", "temperature", "pressure", "winddirection", "windspeed", "humidity"];
    if(array_diff_key(array_flip($keys), $_POST)) {
        die("{\"Response\": \"No data\"}");
    } else {
        $datetime = $_POST["datetime"];
        $temp = $_POST["temperature"];
        $bar = $_POST["pressure"];
        $dir = $_POST["winddirection"];
        $kmh = $_POST["windspeed"];
        $hum = $_POST["humidity"];

        $date = new DateTime(strtotime($datetime));
        $year = $date->format("Y");

        $arr2 = array_merge($arr2, [
            $date->format("Y-m-d H:i:s"),
            (int)$temp,
            (double)$bar,
            (int)$hum,
            $dir,
            (int)$kmh
        ]);
        
        $result = $db->dmlCommand(
            "INSERT INTO `y$year` (data, temperatura, pressione, umidita, `direzione-vento`, `km-h`) VALUES (?, ?, ?, ?, ?, ?)",
            $arr2
        );

        if (!$result) {
            header("HTTP/1.1 500 Internal Server Error");
            die("{\"Response\": \"Database error\"}");
        }
        
        header("Operation complete");
        header("HTTP/1.0 200 OK");

        die("{\"Response\": \"Done\"}");
    }

?>