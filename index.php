<?php
    require("functions.php");
    $date = new DateTime(date('Y-m-d H:i:s'));
    $date->setTime(0, 0 , 0);
    query("INSERT INTO 2022 (`data`, `temperatura`, `pressione`, `umidita`, `direzione-vento`, `km-h`) VALUES ('".$date->format('Y-m-d H:i:s')."', 1, 33.0, 100, 'NW', 1)");
    for($i = 0; $i < 8758; $i++) {
        $date->modify("+1 day");
    }
    
    echo var_dump(query("SELECT * FROM 2022"));