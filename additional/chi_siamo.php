<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storico</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    
    <!-- sfondi -->

    <video src="../IMG/Nuvole - 8599.mp4" autoplay loop muted></video>
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

    <h2 class="benvenuto noiSiamo">
        Dalla scuola ITIS Vallauri Velletri:
    </h2>

    <h2 class="benvenuto">
        Questo è un progetto elaborato da 3 classi per illustrare le competenze acquisite.
    </h2>

    <div class="plusInfo noiSiamo">
        <h2 class="benvenuto">
            Per maggiori informazioni sulla scuola:
        </h2>

        <a href="https://www.itisvallauri.edu.it">
            <h2 class="benvenuto">| Sito della Scuola |</h2>
        </a>
    </div>

    <!-- mappa -->

    <h2 class="benvenuto noiSiamo"> 
        Posizione della Scuola: 
    </h2>

    <div class="google-maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2980.0416283289383!2d12.775315615372184!3d41.676444379238745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13259d347813ad7d%3A0x973948516bf1e19f!2sITIS%20Giancarlo%20Vallauri!5e0!3m2!1sit!2sit!4v1678190626853!5m2!1sit!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="spazio sfondotrasparente sfondOscurato">
        <div class="sottoSpazio1">
            <h2 class="benvenuto">
                La Storia della scuola
            </h2>
            <hr>
            <h2 class="storia">
                La scuola viene istituita nell' A. S. 1960 /61 come succursale dell'I.T.I.S. "E. Fermi" di Roma all'epoca esistevano solo tre sezioni: la sezione A di 37 alunni la sezione B di 37 alunni la sezione C di 39 alunni le quali erano seguite dal Prof. Diana Umberto. il quale è stato il coordinatore con la partecipazione dell' I.T.I.S. E. Fermi di Roma per l' avvio e la gestione iniziale della scuola. Tutti i comuni a sud di Roma come ad esempio i Castelli , Colleferro ecc. insieme ad alcuni comuni della provincia di Latina, fino a giungere a Terracina, rappresentano il bacino d 'utenza dell' attuale I.T.I.S. "Giancarlo Vallauri" di Velletri. Inizialmente l'Istituto si appoggiò presso l' I.T.C.G. "Cesare Battisti" , per passare poi dal palazzo comunale ad una villetta non troppo distante l'ospedale di Velletri. Nel mese di novembre dell'anno 1965 l'I.T.I.S. Vallauri, si trasferì definitivamente presso la sede attuale di via Salvo D' Acquisto. Nell' A. S. 1968 / 69 divenne istituto autonomo e prese per l'appunto il nome dell' ingegnere "Giancarlo Vallauri". Dalla sua autonomia ad oggi, più di cinquemila sono stati gli studenti diplomati. Questo perché il numero delle sezioni e degli alunni è progressivamente cresciuto nel corso del tempo; fino a raggiungere, un numero complessivo di 53 classi, 14 di esse sono state ospitate nella sede staccata di via Paolina a Velletri. La scuola dispone inoltre di diversi laboratori, dove gli alunni possono predisporre numerose esperienze. Al tempo stesso, dopo l'entrata in vigore dei bacini di utenza, (DISTRETTO N°39/42) si è precisata e definita l'area geografica dell'I.T.I.S. "G. Vallauri": gli allievi provengono ,infatti, prevalentemente da Lariano, Genzano, Albano, Ariccia, Lanuvio, Cecchina, S.Maria delle Mole, Castel Gandolfo, Ciampino, Cisterna e Artena oltre che , come ovvio, dalla stessa Velletri. Alla iniziale specializzazione in Elettronica Industriale si sono affiancati, più di recente nuovi corsi (INFORMATICA e LICEO SCIENTIFICO TECNOLOGICO), ciò nell'intento di rispondere con sempre maggiore efficacia alla domanda e alle legittime esigenze del mondo del lavoro che, alla scuola chiede un continuo sforzo di aggiornamento per adeguare i futuri periti all'apprendimento e all'uso delle nuove tecnologie.
            </h2>
            <div id="timeLine">
                <h2 class="benvenuto">---Time Line-></h2>
                <div class="subTimeLine">
                    <div class="subTimeLineDescription">
                        <h4>Settembre 1960</h4>
                        <h2>Fondazione della scuola</h2>
                        <h3>La scuola viene istituita nell' A. S. 1960 /61 come succursale dell'I.T.I.S. "E. Fermi" di Roma all'epoca esistevano solo tre sezioni.</h3>
                    </div>
                    <div class="subTimeLineDescription">
                        <h4>Novembre 1965</h4>
                        <h2>Trasferimento sede</h2>
                        <h3>Nel mese di novembre dell'anno 1965 l'I.T.I.S. Vallauri, si trasferì definitivamente presso la sede attuale di via Salvo D' Acquisto.</h3>
                    </div>
                    <div class="subTimeLineDescription">
                        <h4>Settembre 1968</h4>
                        <h2>Ridenominazione istituto</h2>
                        <h3>Nell' A. S. 1968 / 69 divenne istituto autonomo e prese per l'appunto il nome dell' ingegnere "Giancarlo Vallauri".</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="sottoSpazio2">
            <img src="../img/scuola1.jpg" alt="IMG-scuola">
            <img src="../img/scuola2.jpg" alt="IMG-scuola">
        </div>
    </div>

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
                    Somma Francesco [Back-End, Front-End, Database]
                </h5>
                
                <h5 class="benvenuto">
                    Fonti Luca [Back-End, Front-End, Database]
                </h5>
                
                <h5 class="benvenuto">     
                    Boaretto Lorenzo [Back-End, Front-End, Grafica]
                </h5>
                
                <h5 class="benvenuto">
                    Cipolla Emilio [Front-end, Grafica]
                </h5>
                
                <h5 class="benvenuto">
                    Pietrosanti Francesco [Front-End, Grafica, Presentazione]
                </h5>
                
                <h5 class="benvenuto">
                    Imbastari Riccardo [Grafica, Presentazione]
                </h5>
                
                <h5 class="benvenuto">
                    Fruncillo Carmine [Idee]
                </h5>
            </div>

            <div class="spazio sfondOscurato">
            <h2 class="benvenuto"> 
                    Partecipanti al Progetto
                    [Scientifico]
                </h2>
                <hr>
                
                <h5 class="benvenuto">
                    . []
                </h5>
                
                <h5 class="benvenuto">
                    . []
                </h5>
                
                <h5 class="benvenuto">     
                    . []
                </h5>
                
                <h5 class="benvenuto">
                    . []
                </h5>
                
                <h5 class="benvenuto">
                    . []
                </h5>
                
                <h5 class="benvenuto">
                    . []
                </h5>
                
                <h5 class="benvenuto">
                    . []
                </h5>
            </div>

        </div>
    </div>
</body>
</html>