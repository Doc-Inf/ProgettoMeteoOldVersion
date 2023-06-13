<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="parole chiave" content="meteo velletri"/>
    <meta name="parole chiave" content="Meteo Velletri"/>
    <meta name="parole chiave" content="meteo Vallauri"/>
    <meta name="parole chiave" content="Progetto Meteo Vallauri"/>
    <meta name="parole chiave" content="Chi Siamo"/>
    <title>Chi siamo</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon-16x16.png"> 
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Charm">

</head>
<body id="chiSiamo" onresize="miniSchermo(),barraMini()"> 
    <!-- sfondi -->

    <div id="sfondoMov">
        <video src="../img/nuvoleP.mp4" autoplay loop muted></video> 
    </div>
    <div class="sfondo"></div>

    <!-- barra superiore di navigazione -->

    <nav class="navigazione">
        <a href="../index.php">
            <span class="material-symbols-outlined">
                home
            </span>
        </a> 
        <a href="./storico.php">Storico</a>
        <?php
            require('../functions.php');
            if(!isset($_SESSION['loginUID'])) echo '<a href="./login.php">Accedi</a>';
            else echo '<a href="../auth/adminpanel.php">Admin Panel</a><a href="../auth/logout.php">Logout</a>';
        ?>
    </nav>

    <a href="https://www.itisvallauri.edu.it">
        <h2 class="scuola noiSiamo">
            ITIS G. Vallauri di Velletri
        </h2>
    </a>

    <p class="descrizione">
        Questo progetto è stato sviluppato per rendere fruibile i dati raccolti dalle rilevazioni della nostra stazione meteorologica in modo semplice e veloce, attraverso il Web.
        Per la creazione della piattaforma, il reperimento e la catalogazione dei dati hanno lavorato gruppi di studenti provenienti dalle classi 3F, 5e e 5G nell'a.s. 2022/2023
    </p>

    <!-- barra scuola info -->
    <div id="barraTot">
        <div class="sfondOscurato barraInfo" id="info" onclick="infoOpen()">
            <h2 id="diPiu">Scopri di più sulla nostra scuola!</h2>
            <span id="infoArrow2" class="material-symbols-outlined">
                navigate_next
            </span>
        </div>

        <div class="sfondOscurato barraInfo" id="mappa" onclick="mappaOpen()">
            <h2>Dove ci troviamo</h2>
            <span id="infoArrow1" class="material-symbols-outlined">
                navigate_next
            </span>
        </div>

        <div class="sfondOscurato barraInfo" id="storia" onclick="storiaOpen()">
            <h2 id="laStoria">Scopri di più sulla storia della scuola!</h2>
            <span id="infoArrow3" class="material-symbols-outlined">
                navigate_next
            </span>
        </div>
    </div>

    <!-- info -->
    
    <div id="infoZone" class="sfondOscurato">
        <h2>Le nostre attività</h2>
        <hr>
        <div>
            <div class="subActive">
                <h2>Informatica</h2>
                <img src="../img/infoimg1.jpg" alt="info img 1">
                <section>
                <p>
                    Il Diplomato in <strong>Informatica</strong> e <strong>Telecomunicazioni</strong> ha competenze specifiche nel campo dei <strong>sistemi informatici</strong>, dell’elaborazione dell’<strong>informazione</strong>, delle <strong>applicazioni e tecnologie Web</strong>, delle <strong>reti</strong> e degli apparati di comunicazione.
                </p><br>
                <p>
                    Ha competenze e conoscenze che si rivolgono all’analisi, progettazione, installazione e gestione di sistemi informatici, <strong>basi di dati</strong>, reti di sistemi di elaborazione, sistemi multimediali e apparati di trasmissione e ricezione dei segnali
                </p>                
                </section>
            </div>
            <div class="subActive">
                <h2>Elettronica e Robotica</h2>   
                <img src="../img/infoimg2.jpg" alt="info img 2">
                <section>
                    <p>
                        Il Diplomato in <strong>Elettronica</strong> ed <strong>Elettrotecnica</strong> ha competenze specifiche nel campo dei materiali e delle tecnologie costruttive dei <strong>sistemi elettrici</strong>, <strong>elettronici</strong> e delle macchine elettriche, della generazione, elaborazione e trasmissione dei <strong>segnali elettrici ed elettronici</strong>, dei sistemi per la generazione, conversione e trasporto dell’<strong>energia elettrica</strong> e dei relativi impianti di distribuzione. 
                    </p><br>                    
                    <p>
                        Collabora nella progettazione, costruzione e collaudo di sistemi elettrici ed elettronici di impianti elettrici e sistemi di automazione.
                    </p>
                </section>
                
            </div>
            <div class="subActive">
                <h2>Scientifico</h2>
                <img src="../img/infoimg3.jpg" alt="info img 3">
                <section>
                    <p>
                        Il percorso di formazione Liceale è quello classico della formazione <strong>liceale-scientifica</strong> della tradizione italiana, con un occhio di riguardo agli elementi applicativi delle conoscenze scientifiche, a partire sin dal primo anno.
                    </p><br>
                    <p>
                        In tale percorso, infatti, la scelta dell’opzione di <strong>“Scienze Applicate”</strong> avviene già dal primo giorno, e dura per l’intero quinquennio.                         
                    </p><br>
                    <p>
                        Tale opzione fornisce alla più completa formazione liceale una curvatura maggiormente affine all’area <strong>tecnico-scientifica</strong>, che non prevede, ad esempio, l’insegnamento della Lingua Latina.
                    </p>
                </section>                
            </div>
        </div>
    </div>

    <!-- mappa -->
   
    <div id="mappaInfo" class="google-maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2980.0416283289383!2d12.775315615372184!3d41.676444379238745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13259d347813ad7d%3A0x973948516bf1e19f!2sITIS%20Giancarlo%20Vallauri!5e0!3m2!1sit!2sit!4v1678190626853!5m2!1sit!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
            

    <!-- storia -->

    <div id="max" class="sfondotrasparente sfondOscurato">
        <div class="sottoSpazio1">
            <h2 class="scuola benvenuto">
                La Storia della scuola
            </h2>
            <hr>
            <p class="storia">
                La scuola viene istituita nell' A. S. 1960 /61 come succursale dell'I.T.I.S. "E. Fermi" di Roma all'epoca esistevano solo tre sezioni: la sezione A di 37 alunni la sezione B di 37 alunni la sezione C di 39 alunni le quali erano seguite dal Prof. Diana Umberto. il quale è stato il coordinatore con la partecipazione dell' I.T.I.S. E. Fermi di Roma per l' avvio e la gestione iniziale della scuola. Tutti i comuni a sud di Roma come ad esempio i Castelli , Colleferro ecc. insieme ad alcuni comuni della provincia di Latina, fino a giungere a Terracina, rappresentano il bacino d 'utenza dell' attuale I.T.I.S. "Giancarlo Vallauri" di Velletri. Inizialmente l'Istituto si appoggiò presso l' I.T.C.G. "Cesare Battisti" , per passare poi dal palazzo comunale ad una villetta non troppo distante l'ospedale di Velletri. Nel mese di novembre dell'anno 1965 l'I.T.I.S. Vallauri, si trasferì definitivamente presso la sede attuale di via Salvo D' Acquisto. Nell' A. S. 1968 / 69 divenne istituto autonomo e prese per l'appunto il nome dell' ingegnere "Giancarlo Vallauri". Dalla sua autonomia ad oggi, più di cinquemila sono stati gli studenti diplomati. Questo perché il numero delle sezioni e degli alunni è progressivamente cresciuto nel corso del tempo; fino a raggiungere, un numero complessivo di 53 classi, 14 di esse sono state ospitate nella sede staccata di via Paolina a Velletri. La scuola dispone inoltre di diversi laboratori, dove gli alunni possono predisporre numerose esperienze. Al tempo stesso, dopo l'entrata in vigore dei bacini di utenza, (DISTRETTO N°39/42) si è precisata e definita l'area geografica dell'I.T.I.S. "G. Vallauri": gli allievi provengono ,infatti, prevalentemente da Lariano, Genzano, Albano, Ariccia, Lanuvio, Cecchina, S.Maria delle Mole, Castel Gandolfo, Ciampino, Cisterna e Artena oltre che , come ovvio, dalla stessa Velletri. Alla iniziale specializzazione in Elettronica Industriale si sono affiancati, più di recente nuovi corsi (INFORMATICA e LICEO SCIENTIFICO TECNOLOGICO), ciò nell'intento di rispondere con sempre maggiore efficacia alla domanda e alle legittime esigenze del mondo del lavoro che, alla scuola chiede un continuo sforzo di aggiornamento per adeguare i futuri periti all'apprendimento e all'uso delle nuove tecnologie.
            </p>
            <div class="timeLine">
                <h2 class="benvenuto">---Time Line-></h2>
                <div class="subTimeLine">
                    <div class="subTimeLineDescription">
                        <p>Settembre 1960</p>
                        <h2>Fondazione della scuola</h2>
                        <p>La scuola viene istituita nell' A. S. 1960 /61 come succursale dell'I.T.I.S. "E. Fermi" di Roma all'epoca esistevano solo tre sezioni.</p>
                    </div>
                    <div class="subTimeLineDescription">
                        <p>Novembre 1965</p>
                        <h2>Trasferimento sede</h2>
                        <p>Nel mese di novembre dell'anno 1965 l'I.T.I.S. Vallauri, si trasferì definitivamente presso la sede attuale di via Salvo D' Acquisto.</p>
                    </div>
                    <div class="subTimeLineDescription">
                        <p>Settembre 1968</p>
                        <h2>Ridenominazione istituto</h2>
                        <p>Nell' A. S. 1968 / 69 divenne istituto autonomo e prese per l'appunto il nome dell' ingegnere "Giancarlo Vallauri".</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="sottoSpazio2">
            <img src="../img/scuola1.jpg" alt="IMG-scuola">
            <img src="../img/scuola2.jpg" alt="IMG-scuola">
        </div>
    </div>

    <!------------------------------------------------------------------------------->
    
    <div id="mini" class="sfondotrasparente sfondOscurato">
        <div class="sottoSpazio1">
            <h2 class="benvenuto">
                La Storia della scuola
            </h2>
            <hr>
            <img id="scuola1" src="../img/scuola1.jpg" alt="IMG-scuola">
            <p class="storia">
                La scuola viene istituita nell' A. S. 1960 /61 come succursale dell'I.T.I.S. "E. Fermi" di Roma all'epoca esistevano solo tre sezioni: la sezione A di 37 alunni la sezione B di 37 alunni la sezione C di 39 alunni le quali erano seguite dal Prof. Diana Umberto. il quale è stato il coordinatore con la partecipazione dell' I.T.I.S. E. Fermi di Roma per l' avvio e la gestione iniziale della scuola. Tutti i comuni a sud di Roma come ad esempio i Castelli , Colleferro ecc. insieme ad alcuni comuni della provincia di Latina, fino a giungere a Terracina, rappresentano il bacino d 'utenza dell' attuale I.T.I.S. "Giancarlo Vallauri" di Velletri.
            </p>
            <img id="scuola2" src="../img/scuola2.jpg" alt="IMG-scuola">
            <p class="storia">
                Inizialmente l'Istituto si appoggiò presso l' I.T.C.G. "Cesare Battisti" , per passare poi dal palazzo comunale ad una villetta non troppo distante l'ospedale di Velletri. Nel mese di novembre dell'anno 1965 l'I.T.I.S. Vallauri, si trasferì definitivamente presso la sede attuale di via Salvo D' Acquisto. Nell' A. S. 1968 / 69 divenne istituto autonomo e prese per l'appunto il nome dell' ingegnere "Giancarlo Vallauri". Dalla sua autonomia ad oggi, più di cinquemila sono stati gli studenti diplomati. Questo perché il numero delle sezioni e degli alunni è progressivamente cresciuto nel corso del tempo; fino a raggiungere, un numero complessivo di 53 classi, 14 di esse sono state ospitate nella sede staccata di via Paolina a Velletri. La scuola dispone inoltre di diversi laboratori, dove gli alunni possono predisporre numerose esperienze. Al tempo stesso, dopo l'entrata in vigore dei bacini di utenza, (DISTRETTO N°39/42) si è precisata e definita l'area geografica dell'I.T.I.S. "G. Vallauri": gli allievi provengono ,infatti, prevalentemente da Lariano, Genzano, Albano, Ariccia, Lanuvio, Cecchina, S.Maria delle Mole, Castel Gandolfo, Ciampino, Cisterna e Artena oltre che , come ovvio, dalla stessa Velletri. Alla iniziale specializzazione in Elettronica Industriale si sono affiancati, più di recente nuovi corsi (INFORMATICA e LICEO SCIENTIFICO TECNOLOGICO), ciò nell'intento di rispondere con sempre maggiore efficacia alla domanda e alle legittime esigenze del mondo del lavoro che, alla scuola chiede un continuo sforzo di aggiornamento per adeguare i futuri periti all'apprendimento e all'uso delle nuove tecnologie.
            </p>
            <div class="timeLine">
                <h2 class="benvenuto">---Time Line-></h2>
                <div class="subTimeLine">
                    <div class="subTimeLineDescription">
                        <p>Settembre 1960</p>
                        <h2>Fondazione della scuola</h2>
                        <p>La scuola viene istituita nell' A. S. 1960 /61 come succursale dell'I.T.I.S. "E. Fermi" di Roma all'epoca esistevano solo tre sezioni.</p>
                    </div>
                    <div class="subTimeLineDescription">
                        <p>Novembre 1965</p>
                        <h2>Trasferimento sede</h2>
                        <p>Nel mese di novembre dell'anno 1965 l'I.T.I.S. Vallauri, si trasferì definitivamente presso la sede attuale di via Salvo D' Acquisto.</p>
                    </div>
                    <div class="subTimeLineDescription">
                        <p>Settembre 1968</p>
                        <h2>Ridenominazione istituto</h2>
                        <p>Nell' A. S. 1968 / 69 divenne istituto autonomo e prese per l'appunto il nome dell' ingegnere "Giancarlo Vallauri".</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div></div>

    <!-- partecipanti & crediti -->

    <div id="partecipanti">

        <div class="spazio sfondOscurato">
            <h2> 
                Partecipanti al Progetto
                [Professori]
            </h2>
            <hr>

            <p class="specialText">
                Bonifazi Andrea [Informatica]
            </p>
            <p class="specialText">
                Rispoli Maria [Scienze e Biologia]
            </p>
        </div>

        <div id="sottoPartecipanti">

            <div class="spazio sfondOscurato">
                <h2> 
                    Partecipanti al Progetto
                    [Informatica]
                </h2>
                <hr>
                
                <p class="benvenuto">
                    Boaretto Lorenzo 
                </p>
                
                <p class="benvenuto">
                    Cipolla Emilio
                </p>
                
                <p class="benvenuto">
                    Fonti Luca    
                </p>
                
                <p class="benvenuto">
                    Fruncillo Carmine
                </p>
                
                <p class="benvenuto">
                    Imbastari Riccardo
                </p>
        
                <p class="benvenuto">
                    Pietrosanti Francesco
                </p>
                
                <p class="benvenuto">
                    Somma Francesco 
                </p>
            </div>

            <div class="spazio sfondOscurato">
            <h2> 
                    Partecipanti al Progetto
                    [Scientifico]
                </h2>
                <hr>
                            
                <p class="benvenuto">
                    Bastianelli Tommaso
                </p>
                
                <p class="benvenuto">     
                    Crespi Edoardo
                </p>
                
                <p class="benvenuto">
                    Masi Gabriele
                </p>
               
            </div>

        </div>
    </div>

    <script type="text/javascript" defer>
        let mappaOn = false;
        let infoOn = false;
        let storiaOn = false;
        let start;
        let end;

        function mappaOpen(){
            if(mappaOn == false){
                mappaOn = true;
                infoOn = true;
                storiaOn = true;
                infoOpen();
                storiaOpen();
                document.getElementById("infoArrow1").innerHTML = "keyboard_arrow_down";
                document.querySelector("#mappaInfo").style.display="flex";
                document.querySelector("#info").style.display="none";
                document.querySelector("#storia").style.display="none";

                start= 30;
                let change= setInterval(()=>{
                    if(start<=100){
                        document.getElementById("mappa").style.width= `${start}%`;
                        ++start;
                        console.log("ciao");

                    }else{ 
                        clearInterval(change);
                    }


                },5);
            }else{
                mappaOn = false;
                document.getElementById("infoArrow1").innerHTML = "navigate_next";


                if(infoOn == false && storiaOn == false){
                    end = 100;
                    let change1 =setInterval(()=>{
                        if(end>30){
                            document.getElementById("mappa").style.width= `${end}%`;
                            --end;
                        }else{
                            document.querySelector("#info").style.display="flex";
                            document.querySelector("#storia").style.display="flex";
                            clearInterval(change1);
                        }
                    },5);
                    
                }
                document.getElementById("infoArrow1").innerHTML = "navigate_next";
                document.querySelector("#mappaInfo").style.display="none";
            }

        }
//info open------------------------------------------------------------
        function infoOpen(){
            if(infoOn == false){
                infoOn = true;
                mappaOn = true;
                storiaOn =true;
                mappaOpen();
                storiaOpen();
                document.getElementById("infoArrow2").innerHTML = "keyboard_arrow_down";
                document.querySelector("#infoZone").style.display="flex";
                document.querySelector("#storia").style.display="none";
                document.querySelector("#mappa").style.display="none"; 

                start= 30;
                let change= setInterval(()=>{
                    if(start<=100){
                        document.getElementById("info").style.width= `${start}%`;
                        document.querySelector("#barraTot").style.alignItems="start"; 
                        document.querySelector("#barraTot").style.justifyContent="start"; 
                        ++start;

                    }else{
                        document.querySelector("#barraTot").style.alignitems="center";
                        document.querySelector("#barraTot").style.justifyContent="space-evenly"; 
                        clearInterval(change);
                    }


                },5);
                
            }else{
                infoOn = false;

                if(storiaOn == false && mappaOn == false){
                    end = 100;
                    let change1 =setInterval(()=>{
                        if(end>30){
                            document.querySelector("#barraTot").style.alignItems="start"; 
                            document.querySelector("#barraTot").style.justifyContent="start"; 
                            document.getElementById("info").style.width= `${end}%`;
                            --end;
                        }else{
                            document.querySelector("#barraTot").style.alignitems="center";
                            document.querySelector("#barraTot").style.justifyContent="space-evenly";
                            document.getElementById("infoArrow2").innerHTML = "navigate_next";
                            document.querySelector("#infoZone").style.display="none";
                            document.querySelector("#storia").style.display="flex";
                            document.querySelector("#mappa").style.display="flex";
                            clearInterval(change1);
                        }
                    },5);
                    
                }
            }
        }
//storia-----------------------------------------------------------
        function storiaOpen(){
            if(storiaOn == false){
                document.querySelector("#info").style.display="none";
                document.querySelector("#mappa").style.display="none"; 
                document.getElementById("infoArrow3").innerHTML = "keyboard_arrow_down";
                console.log(document.querySelector("#info").style.display);
                storiaOn = true;
                mappaOn = true;
                infoOn = true;
                mappaOpen();
                infoOpen();

                start= 30;
                let change= setInterval(()=>{
                    if(start<=100){
                        document.getElementById("storia").style.width= `${start}%`;
                        document.querySelector("#barraTot").style.alignItems="end"; 
                        document.querySelector("#barraTot").style.justifyContent="end"; 
                        ++start;

                    }else{
                        document.querySelector("#barraTot").style.alignitems="center";
                        document.querySelector("#barraTot").style.justifyContent="space-evenly"; 
                        clearInterval(change);
                    }


                },5);
                
                
            }else{
                storiaOn = false;

                if(infoOn == false && mappaOn == false){
                    end = 100;
                    let change1 =setInterval(()=>{
                        if(end>30){
                            document.querySelector("#barraTot").style.alignItems="end"; 
                            document.querySelector("#barraTot").style.justifyContent="end"; 
                            document.getElementById("storia").style.width= `${end}%`;
                            --end;
                        }else{
                            document.querySelector("#barraTot").style.alignitems="center";
                            document.querySelector("#barraTot").style.justifyContent="space-evenly";
                            document.getElementById("infoArrow3").innerHTML = "navigate_next";
                            document.querySelector("#info").style.display="flex";
                            document.querySelector("#mappa").style.display="flex";
                            clearInterval(change1);
                        }
                    },5);
                    
                }
            }
            miniSchermo();
        }
//minischermo---------------------------------------------------------------------
        function miniSchermo(){
            let x = document.getElementById("chiSiamo");
            let y;
            y = x.clientWidth;
            if(storiaOn == true){
                if(y < 1400){
                    document.querySelector("#max").style.display="none";
                    document.querySelector("#mini").style.display="flex";
                }else{
                    document.querySelector("#max").style.display="flex";
                    document.querySelector("#mini").style.display="none";
                }
            }else{
                document.querySelector("#max").style.display="none";
                document.querySelector("#mini").style.display="none";
            }
        }
        miniSchermo();

        function barraMini(){
            let x = document.getElementById("chiSiamo");
            let y;
            y = x.clientWidth;
            if(y < 1400){
                document.getElementById("diPiu").innerHTML = "Su di noi";
                document.getElementById("laStoria").innerHTML = "La nostra storia";
            }else{
                document.getElementById("diPiu").innerHTML = "Scopri di più sulla nostra scuola!";
                document.getElementById("laStoria").innerHTML = "Scopri di più sulla storia della scuola!";
            }
        }
        barraMini();

        infoOpen();
    </script>

</body>
</html>