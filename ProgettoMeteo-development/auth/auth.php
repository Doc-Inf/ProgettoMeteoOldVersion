<?php

    require("../functions.php");

    if(isset($_POST)) {
        $err;
        if($_POST['username'] == "") $err['user'] = "username non puo essere vuoto.";
        if($_POST['password'] == "") $err['pass'] = "password non puo essere vuota.";
        
        if(!isset($err)) {
            if($config->database->dbLibrary === "pdo"){
                $res = $db->query('SELECT id, last_access FROM login WHERE username=? AND password=?;',[ $_POST['username'], hash("sha256", $_POST['password'])])[0];
            }else{
                if($config->database->dbLibrary === "mysqli"){
                    $res = $db->query('SELECT id, last_access FROM login WHERE username=? AND password=?;',[ "ss", $_POST['username'], hash("sha256", $_POST['password'])])[0];
                }else{
                    die("Libreria di connessione con il DBMS, specificata nel file di configurazione, non è valida");
                }
            }
            
            if(!is_null($res)) {
                $_SESSION['loginUID'] = $res['id'];
                $_SESSION['lastLogin'] = $res['last_access'];
                $date = new DateTime(date('Y/m/d H:i:s'));
                $date = $date->format("Y-m-d H:i:s");
                $db->dmlCommand("UPDATE login SET last_access='".$date."' where id =".$res['id']);
                echo "redirecting...";
                redirect("../auth/adminpanel.php");
            } else $err['general'] = "username o password errati";
        }
        if(isset($err)) redirect_post_data("../additional/login.php", $err);
    } else {
        redirect("../additional/login.php");
    }    

?>