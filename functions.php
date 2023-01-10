<?php
    error_reporting(E_ERROR);    

    function query(string $sql, string $dbname = "meteo") {
        $conn = new mysqli("localhost", "root", "", $dbname, 6666);
        if($conn->connect_error) die("Connessione fallita ".$conn->connect_error);
        
        $query = $conn->query($sql);
        if($query->num_rows > 0) {
            $res = $query->fetch_all(MYSQLI_ASSOC);
            return $res;
        }
    }
?>