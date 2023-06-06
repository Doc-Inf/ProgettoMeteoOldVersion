<?php
    require("../functions.php");
    session_destroy();
    redirect("../additional/login.php");
?>