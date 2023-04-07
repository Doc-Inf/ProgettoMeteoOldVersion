<?php
    require("../functions.php");

    if($_POST == null || $_SESSION['loginUID'] == null) {
        redirect("adminpanel.php");
    } else {
        $temperatura = $_POST['temp'];
        $pressione = $_POST['pres'];
        $umidita = $_POST['umid'];
        $velocita = $_POST['velo'];
        $direzione = $_POST['dire'];
        $date = new DateTime(date('Y/m/d H:i:s'));
        $year = $date->format("Y");
        $date = $date->format("Y-m-d H:i:s");
        query("INSERT INTO `$year`(temperatura,pressione,umidita,`direzione-vento`,`km-h`,data) VALUE ($temperatura, $pressione, $umidita, '$direzione', $velocita, '$date');");
        redirect_post_data("adminpanel.php", ['insert' => "done"]);
    }
?>