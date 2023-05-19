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


    <title>Storico</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Charm">
</head>
<body id="chiSiamo" onresize="miniSchermo()">
    <?php 
        //include '';
    ?>
    <!-- sfondi -->
    <script>
        let wtStatus= <?php echo $wtStatus?>
        console.log("variabile super"+wtStatus);
    </script>
    <video src="../img/nuvoleP.mp4" autoplay loop muted></video>
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

    <h2 class="scuola noiSiamo">
        ITIS G. Vallauri di Velletri
    </h2>

    <p class="descrizione">
        Questo progetto è stato sviluppato per rendere fruibile i dati raccolti dalle rilevazioni della nostra stazione meteorologica in modo semplice e veloce, attraverso il Web.
        Per la creazione della piattaforma, il reperimento e la catalogazione dei dati hanno lavorato gruppi di studenti provenienti dalle classi 3F, 5e e 5G nell'a.s. 2022/2023
    </p>

    <div class="plusInfo noiSiamo">
        <h2 class="benvenuto">
            Per maggiori informazioni sulla scuola:
        </h2>

        <a href="https://www.itisvallauri.edu.it" class="link">
            <h2 class="benvenuto">| Sito della Scuola |</h2>
        </a>
    </div>

    <!-- mappa -->

    <h2 class="benvenuto noiSiamo"> 
        Qui è dove ci troviamo: 
    </h2>

    <div class="google-maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2980.0416283289383!2d12.775315615372184!3d41.676444379238745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13259d347813ad7d%3A0x973948516bf1e19f!2sITIS%20Giancarlo%20Vallauri!5e0!3m2!1sit!2sit!4v1678190626853!5m2!1sit!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div id="max" class="spazio sfondotrasparente sfondOscurato">
        <div class="sottoSpazio1">
            <h2 class="scuola benvenuto">
                La nostra scuola
            </h2>
            <hr>
            <p class="storia">
                Benvenuti noi siamo studenti presso l'istituto tecnico I.T.I.S Vallauri di Velletri, una scuola in grado di fornire un ottima preparazione ai nostri studenti. La scuola offre un percorso di studi che permette una volta terminato, di proseguire con un istruzione universitaria, in caso opposto i nostri studenti escono con un ottima preparazione per il mondo lavorativo. Qui nel nostro istituto durante il triennio gli studenti svolgeranno materie prettamente inerenti al percorso come : informatica-telecomunicazioni per l'indirizzo informatico e elettronica-robotica per l'indirizzo elettronico. L'apprendimento sarà reso completo dai nostri laboratori dove gli studenti avranno a disposizione computer e componenti elettronico-robotiche a seconda dell'indirizzo, abbiamo 9 laboratori che vanno da materie del biennio, come chimica e fisica, a materie del triennio come informatica e robotica, qui sopra riportati ci sono il laboratorio di informatica e di sistemi elettronici. Inoltre la nostra scuola offre non solo formazione tecnica, ma tra i percorsi di studio è possibile scegliere il liceo scientifico scienze applicate, scegliendo un percorso prettamente orientato al proseguimento degli studi.
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
            <img src="../img/lab-sistemi-elettronici01-1.jpg" alt="IMG-scuola">
            <img src="../img/lab-sistemi03.jpg" alt="IMG-scuola">
        </div>
    </div>

    <!------------------------------------------------------------------------------->
    
    <div id="mini" class="spazio sfondotrasparente sfondOscurato">
        <div class="sottoSpazio1">
            <h2 class="benvenuto">
                La nostra scuola
            </h2>
            <hr>
            
            <p class="storia" id="storia0">
            Benvenuti noi siamo studenti presso l'istituto tecnico I.T.I.S Vallauri di Velletri, una scuola in grado di fornire un ottima preparazione ai nostri studenti. La scuola offre un percorso di studi che permette una volta terminato, di proseguire con un istruzione universitaria, in caso opposto i nostri studenti escono con un ottima preparazione per il mondo lavorativo.<img src="../img/lab-sistemi-elettronici01-1.jpg" alt="IMG-scuola"> Qui nel nostro istituto durante il triennio gli studenti svolgeranno materie prettamente inerenti al percorso come : informatica-telecomunicazioni per l'indirizzo informatico e elettronica-robotica per l'indirizzo elettronico.

            </p>
            
            <p class="storia" id="storia1">
            L'apprendimento sarà reso completo dai nostri laboratori dove gli studenti avranno a disposizione computer e componenti elettronico-robotiche a seconda dell'indirizzo,<img src="../img/lab-sistemi03.jpg" alt="IMG-scuola"> abbiamo 9 laboratori che vanno da materie del biennio, come chimica e fisica, a materie del triennio come informatica e robotica, qui sopra riportati ci sono il laboratorio di informatica e di sistemi elettronici. Inoltre la nostra scuola offre non solo formazione tecnica, ma tra i percorsi di studio è possibile scegliere il liceo scientifico scienze applicate, scegliendo un percorso prettamente orientato al proseguimento degli studi.
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

    <div id="partecipanti">

        <div class="spazio sfondOscurato">
            <h2 class="benvenuto"> 
                Partecipanti al Progetto
                [Professori]
            </h2>
            <hr>

            <h5 class="benvenuto specialText">
                Bonifazi Andrea [Informatica]
            </h5>
            <h5 class="benvenuto specialText">
                Rispoli Maria [Scienze e Biologia]
            </h5>
        </div>

        <div id="sottoPartecipanti">

            <div class="spazio sfondOscurato">
                <h2 class="benvenuto"> 
                    Partecipanti al Progetto
                    [Informatica]
                </h2>
                <hr>
                
                <h5 class="benvenuto">
                    Boaretto Lorenzo
                </h5>
                
                <h5 class="benvenuto">
                    Cipolla Emilio
                </h5>
                
                <h5 class="benvenuto">
                    Fonti Luca    
                </h5>
                
                <h5 class="benvenuto">
                    Fruncillo Carmine
                </h5>
                
                <h5 class="benvenuto">
                    Imbastari Riccardo
                </h5>
                
                <h5 class="benvenuto">
                    Pietrosanti Francesco
                </h5>
                
                <h5 class="benvenuto">
                    Somma Francesco 
                </h5>
            </div>

            <div class="spazio sfondOscurato">
            <h2 class="benvenuto"> 
                    Partecipanti al Progetto
                    [Scientifico]
                </h2>
                <hr>
                            
                <h5 class="benvenuto">
                    Bastianelli Tommaso
                </h5>
                
                <h5 class="benvenuto">     
                    Crespi Edoardo
                </h5>
                
                <h5 class="benvenuto">
                    Masi Gabriele
                </h5>
               
            </div>

        </div>
    </div>

    <script type="text/javascript" defer>
        miniSchermo();
        function miniSchermo(){
            let x = document.getElementById("chiSiamo");
            let y;
            y = x.clientWidth;
            if(y < 1400){
                document.querySelector("#max").style.display="none";
                document.querySelector("#mini").style.display="flex";
            }else{
                document.querySelector("#max").style.display="flex";
                document.querySelector("#mini").style.display="none";
            }
        }
    </script>
</body>
</html>