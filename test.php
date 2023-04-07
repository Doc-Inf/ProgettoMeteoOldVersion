<html>
<head>
    <meta charset="UTF-8">
    
    <title>aaaa</title>
</head>
<body>
    <?php 
        require("functions.php");
        $date = new DateTime(date('Y/m/d H:i:s'));
        

        $res = query("select * from `2023` where id=1");
        echo json_encode($res)."<br>";
    ?>
</body>
</html>