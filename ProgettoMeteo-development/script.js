//variabili per il cambio di dati
let numeroMiusrazioni = 0;
let cielo = "nuvoloso";
let valoreTemperatura = 25;
let valoreUmidità = 80; //al valore dell'umidità va dato un numero da 0 a 100 in base alla rispettiva %
let valorePressione = 999;
let direzioneVento = "nord";
let velocitàVento = 30;

//umidità registrata settimanalmente
let umiLun = 0;
let umiMar = 15
let umiMer = 20;
let umiGio = 10;
let umiVen = 50;
let umiSab = 10;
let umiDom = 0;

//temperatura registrata settimanalmente
let tempLun = 10;
let tempMar = 7;
let tempMer = 10;
let tempGio = 0;
let tempVen = 10;
let tempSab = 20;
let tempDom = 90;


//orologio

window.onload = setInterval(Orologio,1000);
function addZero(i) {
if (i < 10) {
  i = "0" + i;
}
return i;
}
function Orologio()
{
  var d = new Date();
  var date = d.getDate();
  var ora = addZero(d.getHours());
  var min = addZero(d.getMinutes());
  var sec = addZero(d.getSeconds());
  document.getElementById("orologio").innerHTML=ora+":"+min+":"+sec;

  //controlla l'umidità ogni 20 minuti e cambia informazioni e icona in base ai dati
  if(min == 20){
    cambiaInfo();
    cambiaIcona();
  }else if(min == 40){
    cambiaInfo();
    cambiaIcona();
  }

}

let on =0;

function tenda(){
  if(on === 0){
    document.querySelector("#tendacharts").style.display="flex";
    document.querySelector(".tendalaterale").style.right="75.5%";
    ++on;
  }else{
    document.querySelector("#tendacharts").style.display="none";
    document.querySelector(".tendalaterale").style.right="0";
    --on;
  }
  
}

//variabili supporto

let x = document.getElementById("zona");
let y = document.getElementById("infolarghezza1");
let z;
let k;

console.log(Math.trunc(x.clientWidth/2));
console.log(Math.trunc(y.clientHeight));


google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);


//grafico curvo 

function drawChart() {

  if(x.clientWidth/2 <= 441){
    z = x.clientWidth-25;
    k = y.clientHeight/2;
  }else if(x.clientWidth/2 >= 700){
    z = 700;
    k = y.clientHeight/1.25;
  }else{
    z= x.clientWidth/2;
    k = y.clientHeight/1.25;
  }

  var data = google.visualization.arrayToDataTable([
      ['Settimana', 'Temperatura', 'Umidità'],
      ['lun',         tempLun,      umiLun],
      ['mar',         tempMar,      umiMar],
      ['mer',         tempMer,      umiMer],
      ['gio',         tempGio,      umiGio],
      ['ven',         tempVen,      umiVen],
      ['sab',         tempSab,      umiSab],
      ['dom',         tempDom,      umiDom]
  ]);

  var options = {
      title: 'Temperatura e Umidità',
      curveType: 'function',
      legend: { position: 'bottom' },
      width: Math.trunc(z),
      height: Math.trunc(k)
  };

  var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

  chart.draw(data, options);
}

//per cambiare icona !!! ANCORA DA MODIFICARE, IMPRECISO !!!

function cambiaIcona(){
  statoAtm = document.getElementById(stato.innerHTML);
  if(valoreUmidità >= 90 && valoreTemperatura <= 15){
    document.getElementById("stato").innerHTML = "rainy";
  }else if(valoreUmidità <= 85 && valoreUmidità >= 75 && valoreTemperatura <= 21){
    document.getElementById("stato").innerHTML = "cloudy";
  }else if(valoreUmidità <= 50 ){
    document.getElementById("stato").innerHTML = "sunny";
  }else{
    document.getElementById("stato").innerHTML = "partly_cloudy_day";
  }
}
cambiaIcona();


function cambiaInfo(){
  document.getElementById("numMisurazione").innerHTML= "Misurazione giornaliera n.: " + numeroMiusrazioni;
  document.getElementById("cielo").innerHTML = "Condizione atmosferica: " + cielo;
  document.getElementById("temperatura").innerHTML = "Temperatura: " + valoreTemperatura + "°";
  document.getElementById("umidità").innerHTML = "Umidità: " + valoreUmidità + "%";
  document.getElementById("pressione").innerHTML = "Pressione: " + valorePressione + " hPa";
  document.getElementById("dirVento").innerHTML = "Direzione vento: " + direzioneVento;
  document.getElementById("velVento").innerHTML = "Velocità vento: " + velocitàVento + " Km/h"
}
cambiaInfo();