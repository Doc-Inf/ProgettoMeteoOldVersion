<?php
    require("../functions.php");

    if($_POST == null || $_SESSION['loginUID'] == null) {
        redirect("adminpanel.php");
    } else {
        $data = $_POST['date'];
        $time = $_POST['time'];
        $temperatura = $_POST['temp'];
        $pressione = $_POST['pres'];
        $umidita = $_POST['umid'];
        $velocita = $_POST['velo'];
        $direzione = $_POST['dire'];
        $date = new DateTime($date . " " . $time);
        $year = $date->format("Y");
        $formattedDate = $date->format("Y-m-d H:i:s");
        $sql = "INSERT INTO `Y$year`(data,temperatura,pressione,umidita,`direzione-vento`,`km-h`) VALUES ('$formattedDate',$temperatura, $pressione, $umidita, '$direzione', $velocita);";
        dmlCommand($sql);
        redirect_post_data("adminpanel.php", ['insert' => "done"]);
    }
?>