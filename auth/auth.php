<?php

    require("../functions.php");

    if(isset($_POST)) {
        $err;
        if($_POST['username'] == "") $err['user'] = "username non puo essere vuoto.";
        if($_POST['password'] == "") $err['pass'] = "password non puo essere vuota.";
        
        if(!isset($err)) {
            $res = query('SELECT id, last_access FROM login WHERE username = "'.$_POST['username'].'" AND password = "'.hash("sha256", $_POST['password']).'"')[0];
            if(!is_null($res)) {
                $_SESSION['loginUID'] = $res['id'];
                $_SESSION['lastLogin'] = $res['last_access'];
                $date = new DateTime(date('Y/m/d H:i:s'));
                $date = $date->format("Y-m-d H:i:s");
                dmlCommand("UPDATE login SET last_access='".$date."' where id =".$res['id']);
                echo "redirecting...";
                redirect("../auth/adminpanel.php");
            } else $err['general'] = "username o password errati";
        }
        if(isset($err)) redirect_post_data("../additional/login.php", $err);
    } else 
        redirect("../additional/login.php");

?>