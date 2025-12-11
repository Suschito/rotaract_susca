<?php
session_start();
// Percorsi dei file JSON
$filePresidenti = 'presidenti.json';
$fileDirettivo = 'direttivo.json';

// Funzione per ordinare i presidenti per anno (dal più vecchio al più nuovo, come nel tuo HTML)
function ordinaPresidenti($a, $b) {
    return strcmp($a['anno'], $b['anno']);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi siamo - Rotaract Trento</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <script defer src="../JS/script.js"></script>
  <script>
    (function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="fygEHNyzvsmlo1_gitv8_";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
  </script>
</head>
<body>

    <div class="top-nav">
        <a href="../index.html"><img src="../Media/Rotaract Club Trento trasparente.png" alt="LOGO" style="height: 110px; vertical-align: middle;"></a>
        <a href="../index.html">Home</a>
        <a href="chisiamo.php" class="active">Chi siamo</a>
        <a href="service.html">Service</a>
        <a href="eventi.html">Eventi</a>
        <a href="collaborazioni.html">Collaborazioni</a>
        <a href="contatti.html">Contatti</a>
        <a href="bollettini.php">Bollettini</a>
        <a href="accedi.php" style="font-weight: bold; border: 2px solid #E2457C; border-radius: 20px; padding: 5px 15px;">Login</a>
    </div>

    <?php if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] === 'admin'): ?>
        <div style="text-align: center; background: #fdf2f7; padding: 10px;">
            <a href="area_riservata.php" class="round-btn" style="padding: 5px 20px; font-size: 0.9em;">✏️ Torna al Pannello Admin</a>
        </div>
    <?php endif; ?>
    <br><br>
    <div class="history-container" style="max-width: 900px; margin: 0 auto; text-align: center; padding-top: 20px;">
        <br>
        <header class="page-header" style="text-align: center;">
            <h1>La storia del Rotaract Club Trento</h1>
        </header>

        <section class="history-section" style="text-align: center;">
            <h2>Le origini <span class="years">(1985 – primi anni ’90)</span></h2>
            <p>
                Il Rotaract Club Trento nasce l’8 luglio 1985, promosso dal Rotary Club Trento e parte del Distretto 2060. In un periodo in cui il Rotaract in Italia si afferma come spazio di incontro e formazione per giovani studenti e professionisti, il club trentino si distingue da subito per entusiasmo, amicizia e voglia di fare. Le prime feste di beneficenza e le attività sociali segnano l’inizio di una tradizione che unisce impegno e convivialità, mentre i rapporti con club come Regensburg, Rovereto e Bolzano riflettono fin da allora una naturale apertura internazionale.
            </p>
        </section>

        <section class="history-section alt-bg" style="text-align: center;">
            <h2>Verso l’Europa – Gli anni della crescita <span class="years">(1990 – 1995)</span></h2>
            <p>
                Negli anni ’90 il Rotaract Club Trento vive una stagione di crescita e apertura internazionale. Nel 1992 partecipa alla fondazione del Rotaract Club di Budapest, il primo dell’Europa dell’Est dopo la caduta del Muro di Berlino, simbolo di una nuova era di cooperazione e amicizia tra giovani europei. Tra i momenti più significativi del decennio spiccano la conferenza “Il Giovane e l’Europa” del 1991 e la prima grande Festa di beneficenza nel 1993, che unisce solidarietà e partecipazione, nonché la celebrazione del decimo anniversario del Club, nel 1995, una serata che riunisce soci e amici per celebrare i primi dieci anni di impegno e amicizia rotaractiana.
            </p>
        </section>

        <section class="history-section" style="text-align: center;">
            <h2>La maturità e la continuità <span class="years">(1996 – 2010)</span></h2>
            <p>
                Con il nuovo millennio il Rotaract Club Trento si conferma una realtà matura e radicata nella comunità. I soci si avvicendano alla guida del club con entusiasmo, mantenendo vivi i valori di amicizia, servizio e crescita personale. Crescono i progetti sul territorio, dalle collaborazioni con associazioni locali alle iniziative di sensibilizzazione sociale, mentre prosegue l’impegno distrettuale e internazionale, con incontri e gemellaggi, in particolare con i club di Regensburg, Rovereto e Bolzano che consolidano legami di amicizia ancora vivi oggi.
            </p>
        </section>

        <section class="history-section alt-bg" style="text-align: center;">
            <h2>Un nuovo impegno per la comunità <span class="years">(2010 – 2020)</span></h2>
            <p>
                Negli anni più recenti il Rotaract Club Trento rinnova il proprio impegno su temi come sostenibilità, inclusione e solidarietà. Tra le iniziative spiccano, service con la Croce Rossa Italiana e le collaborazioni con la Protonterapia di Trento. Durante la pandemia del 2020 il club partecipa alle campagne #IoRestoACasa e #WeStopCovid, dimostrando vicinanza alla comunità e capacità di adattamento ai nuovi tempi.
            </p>
        </section>

        <section class="history-section" style="text-align: center;">
            <h2>Il presente e il futuro <span class="years">(2021 – oggi)</span></h2>
            <p>
                Negli ultimi anni il Rotaract Club Trento ha continuato a distinguersi per la qualità dei suoi progetti, unendo tradizione e innovazione. Nel 2025, in occasione dei 40 anni del Club, il Rotaract Trento celebra una storia fatta di persone, progetti e ideali condivisi — con uno sguardo rivolto al futuro e alle nuove generazioni di giovani pronti a servire la comunità. Un’eredità viva, dalla fondazione del 1985 a oggi, centinaia di soci e amici hanno contribuito alla crescita del Club, ognuno lasciando un segno unico, testimoniando quarant’anni di entusiasmo, amicizia e impegno.
            </p>
        </section>
    </div>

    <div class="timeline-zigzag">
        <h2>Presidenti Rotaract Club Trento (1985–2026)</h2>
        <div class="timeline-row">
            <?php
            if (file_exists($filePresidenti)) {
                $presidenti = json_decode(file_get_contents($filePresidenti), true);
                if ($presidenti) {
                    // Ordiniamo per anno crescente (dal 1985 in poi)
                    usort($presidenti, 'ordinaPresidenti');

                    foreach ($presidenti as $pres) {
                        // Stampiamo il blocco HTML con i dati del JSON
                        echo '<div class="event">';
                        echo '<strong>' . htmlspecialchars($pres['anno']) . '</strong>';
                        echo '<span>' . htmlspecialchars($pres['nome']) . '</span>';
                        echo '</div>';
                    }
                }
            } else {
                echo "<p>Nessun dato presente nell'archivio.</p>";
            }
            ?>
        </div>
    </div>

    <div class="timeline-zigzag">
        <h2>CONSIGLIO DIRETTIVO A/R 2025/2026</h2>
        <div class="timeline-row">
            <?php
            if (file_exists($fileDirettivo)) {
                $direttivo = json_decode(file_get_contents($fileDirettivo), true);
                if ($direttivo) {
                    foreach ($direttivo as $membro) {
                        if (!empty($membro['nome'])) {
                            echo '<div class="event">';
                            echo '<strong>' . htmlspecialchars($membro['ruolo']) . '</strong>';
                            echo '<span>' . htmlspecialchars($membro['nome']) . '</span>';
                            echo '</div>';
                        }
                    }
                }
            } else {
                 echo "<p>Direttivo non ancora caricato.</p>";
            }
            ?>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-left">
                <a href="../index.html"><img src="../Media/Rotaract Club Trento trasparente.png" alt="Rotaract" class="footer-logo"></a>
                <h3>Rotaract Club Trento</h3>
            </div>

            <div class="footer-center">
                <p><strong>Contatti</strong><br><br>
                    Email: <a href="mailto:rac.trento@rotaract2060.it">rac.trento@rotaract2060.it</a>
                </p>
                <p>
                    Sede legale: <a href="https://maps.app.goo.gl/9hHKLuXVx7wB1wM76" target="_blank">Piazza Dante 20, 38122 Trento (TN)</a>
                    <br><br>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2790.347575306354!2d11.11933737666245!3d46.07122897108966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4782714c3e746761%3A0x8633716075135112!2sPiazza%20Dante%2C%2020%2C%2038122%20Trento%20TN!5e0!3m2!1sit!2sit!4v1709123456789!5m2!1sit!2sit" width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>          
                </p>
            </div>

            <div class="footer-right">
                <div class="social-icons">
                    <a href="https://www.facebook.com/rotaracttrento/"><img src="../Media/facebook.png" alt="Facebook"></a>
                    <a href="https://www.instagram.com/rotaractclubtrento/"><img src="../Media/instagram.png" alt="Instagram"></a>
                </div>
            </div>
        </div>
        <p class="footer-bottom">Rotaract Club Trento © 2025 | Privacy Policy | Cookie Policy</p>
    </footer>

</body>
</html>