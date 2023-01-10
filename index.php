<?php
    require("functions.php");
    echo phpversion()."\n";
    if(!extension_loaded("mysqli")) echo "whaaat";
    $date = new DateTime(date('Y/m/d H:i:s'));
    $direction = random_int(1, 8);
    switch ($direction) {
        case '1':
            $direction = 'N';
            break;
        
        case '2':
            $direction = 'NE';
            break;
        
        case '3':
            $direction = 'NW';
            break;
        
        case '4':
            $direction = 'S';
            break;
        
        case '5':
            $direction = 'SE';
            break;
        
        case '6':
            $direction = 'SW';
            break;
        
        case '7':
            $direction = 'E';
            break;
        
        case '8':
            $direction = 'W';
            break;
   }

    for($i = 0; $i < 8761; $i++) {
        query("INSERT INTO `2023` (`id`, `data`, `temperatura`, `pressione`, `umidita`, `direzione-vento`, `km-h`) VALUES ($i, '".$date->format('Y/m/d H:i:s')."', ".random_int(1, 100).", ".rand(0,25565).", ".random_int(1,100).", '$direction', ".random_int(1,100).")");
        $date->modify("+1 day");
    }
    
    echo var_dump(query("SELECT * FROM `2023`"));
    