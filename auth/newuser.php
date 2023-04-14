<?php
    require("../functions.php");

    if($_POST == null || $_SESSION['loginUID'] == null) {
        redirect("adminpanel.php");
    } else { 
        $username = $_POST['username'];
        $password = hash("sha256", $_POST['password']);
        dmlCommand("INSERT INTO login(username, password) value('$username', '$password');");
        redirect_post_data("adminpanel.php", ['admin' => "done"]);
    }
?>