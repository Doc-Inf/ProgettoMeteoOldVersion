<?php
    function insertRilevazione(){
        global $db;
        if($_POST == null || $_SESSION['loginUID'] == null) {
            redirect("adminpanel.php");
        } 
        $data = $_POST['date'];
        $time = $_POST['time'];
        $temperatura = $_POST['temp'];
        $pressione = $_POST['pres'];
        $umidita = $_POST['umid'];
        $velocita = $_POST['velo'];
        $direzione = $_POST['dire'];
        $date = new DateTime($data . " " . $time);
        $year = $date->format("Y");
        $formattedDate = $date->format("Y-m-d H:i:s");
        $sql = "INSERT INTO `Y$year`(data,temperatura,pressione,umidita,`direzione-vento`,`km-h`) VALUES ('$formattedDate',$temperatura, $pressione, $umidita, '$direzione', $velocita);";
        $db->dmlCommand($sql);
        $_POST['insert'] = "done";        
    }

    function createUser(){
        global $db;
        if($_POST == null || $_SESSION['loginUID'] == null) {
            redirect("adminpanel.php");
        }  
        $username = $_POST['username'];
        $password = hash("sha256", $_POST['password']);
        $db->dmlCommand("INSERT INTO login(username, password) value('$username', '$password');");
        $_POST['admin'] = "done"; 
    }


?>