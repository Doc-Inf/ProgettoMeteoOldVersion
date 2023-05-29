<?php
    require_once 'functions.php';

?>

<?php        
    $date = new DateTime(date('Y/m/d H:i:s'));
    $year = $date->format("Y");
    $res = $db->query("SELECT * FROM `y$year` where data = (SELECT MAX(data) FROM `y$year`);")[0];
    $glwt= "";
?>
<script>
    const giorniSet = ["Lun","Mar","Mer","Gio","Ven","Sab","Dom"];
    let conta = [];       
    let giorno = <?php 
        $endDate = new DateTime( $db->query("SELECT MAX(data) as data FROM `y$year`")[0]["data"] );
        echo ( $endDate->format("N")-1);
    ?>; 
    let dataMisurazione = "<?php echo formatDate($res['data']); ?>";        
    let valoreTemperatura = <?php echo $res['temperatura']?>;
    let valoreUmidità = <?php echo $res['umidita']?>; //al valore dell'umidità va dato un numero da 0 a 100 in base alla rispettiva %
    let valorePressione = <?php echo $res['pressione']?>;
    let direzioneVento = '<?php echo $res['direzione-vento']?>';
    let velocitàVento = <?php echo $res['km-h']?>;
    function cambiaIcona(){     
        if(valoreUmidità >= 90 && valoreTemperatura<= 15){
            wtStatus= "rainy";
        }else if(valoreUmidità <= 85 && valoreUmidità >= 75 && valoreTemperatura <= 21){
            wtStatus= "cloudy";
        }else if(valoreUmidità <= 50 ){
            wtStatus= "sunny";
        }else{
            wtStatus= "semi-cloudy";
        }
    }
    cambiaIcona();

    function cambiaSfondo(){
        switch(wtStatus){
            case "cloudy": {
                document.getElementById("sfondoMov").innerHTML= `<video src="../img/nuvoloso.mp4" autoplay loop muted></video> `;
                break;
            }
            case"sunny":{
                document.getElementById("sfondoMov").innerHTML= `<video src="../img/sole.mp4" autoplay loop muted></video> `;

                break;
            }
            case"rainy":{
                document.getElementById("sfondoMov").innerHTML= `<video src="../img/pioggia.mp4" autoplay loop muted></video> `;

                break;
            }
            case"semi-cloudy":{
                document.getElementById("sfondoMov").innerHTML= `<video src="../img/nuvoleP.mp4" autoplay loop muted></video> `;

                break;
            }
            
        }

    }
    cambiaSfondo();
</script>
<?php          

    $startDate = (new DateTime($endDate->format("Y-m-d H:i:s")))->modify("-7 day");
    $giorni = [];
    $temperaturaSettimanale = [];
    $umiditaSettimanale = [];
    for($i=6;$i>=0;--$i){
        $currentDay = (new DateTime($endDate->format("Y-m-d H:i:s")))->modify("-$i day");
        $res = $db->query("SELECT AVG(umidita) as umiditaMedia, AVG(temperatura) as temperaturaMedia FROM `y$year` WHERE DATE(data)= '".$currentDay->format('Y-m-d')."';");
        $giorni[] = $currentDay;
        $temperaturaSettimanale[] = $res[0]['temperaturaMedia'];
        $umiditaSettimanale[] = $res[0]['umiditaMedia'];
    }


?>