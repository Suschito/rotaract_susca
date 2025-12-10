<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bollettini - Rotaract Trento</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <script defer src="../JS/script.js"></script>
    <script>
        (function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="fygEHNyzvsmlo1_gitv8_";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
    </script>
</head>
<body>
    <div class="top-nav">
        <a href="../index.html"><img src="../Media/Rotaract Club Trento trasparente.png" alt="LOGO" style="height: 110px; vertical-align: middle;"></a>
        <a href="../index.html" >Home</a>
        
        <a href="chisiamo.php">Chi siamo</a>
        <a href="service.html">Service</a>
        <a href="eventi.html">Eventi</a>
        <a href="collaborazioni.html">Collaborazioni</a>
        <a href="contatti.html">Contatti</a>
        <a href="bollettini.php" class="active" >Bollettini</a>
        
        <a href="accedi.php" style="font-weight: bold; border: 2px solid #E2457C; border-radius: 20px; padding: 5px 15px;">Login</a>
    </div>
    
    <br><br><br>

    <div class="archivio-container">
        <h2 style="text-align: center;">Archivio Bollettini</h2>

        <?php
        // Definisci la cartella dove sono salvati i PDF
        $dirBollettini = "../Bollettini";

        // Controlla se la cartella esiste
        if (is_dir($dirBollettini)) {
            // Scansiona la cartella per trovare gli ANNI, ordinati dal più recente (descending)
            $anni = scandir($dirBollettini, SCANDIR_SORT_DESCENDING);
            
            // Rimuovi i puntini '.' e '..'
            $anni = array_diff($anni, array('..', '.'));

            foreach ($anni as $anno) {
                $pathAnno = $dirBollettini . "/" . $anno;

                // Assicuriamoci che sia una cartella (es. "2024")
                if (is_dir($pathAnno)) {
                    $idContainer = "mesi-" . $anno;
                    ?>

                    <div class="annata">
                        <div class="header-annata" onclick="toggleMesi('<?= $idContainer ?>')">
                            <h3>ANNO ROTARACT <?= htmlspecialchars($anno) ?>-<?= htmlspecialchars($anno) + 1 ?></h3>
                            <span class="arrow">▶</span>
                        </div>

                        <div class="mesi-container" id="<?= $idContainer ?>">
                            <?php
                            // Scansiona i file dentro la cartella dell'anno
                            $files = scandir($pathAnno);
                            $files = array_diff($files, array('..', '.'));
                            
                            // Ordina file (opzionale: potresti voler implementare un ordine mesi specifico)
                            // Per ora usa l'ordine alfabetico standard
                            
                            if (count($files) > 0) {
                                foreach ($files as $file) {
                                    // Filtra solo i PDF
                                    if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                                        // Estrai il nome del mese dal file.
                                        // Formato atteso: bollettino-mese-anno.pdf
                                        // Esempio: bollettino-gennaio-2024.pdf -> "Gennaio"
                                        
                                        $parts = explode('-', $file);
                                        // Se il file ha i trattini, proviamo a prendere la parte centrale
                                        if (count($parts) >= 2) {
                                            $nomeMese = ucfirst($parts[1]); 
                                        } else {
                                            $nomeMese = $file; // Fallback se il nome non è standard
                                        }

                                        $filePath = $pathAnno . "/" . $file;
                                        ?>
                                        
                                        <a href="<?= htmlspecialchars($filePath) ?>" target="_blank" download class="rettangolo-mese">
                                            <?= htmlspecialchars($nomeMese) ?>
                                        </a>

                                        <?php
                                    }
                                }
                            } else {
                                echo "<p style='padding:10px; color:#666;'>Nessun bollettino caricato.</p>";
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                }
            }
        } else {
            echo "<p style='text-align:center;'>Cartella Bollettini non trovata.</p>";
        }
        ?>

    </div>  
    
    <script>
        function toggleMesi(idContainer) {
            var container = document.getElementById(idContainer);
            var annataHeader = container.previousElementSibling; // Prende l'elemento header sopra

            // Aggiunge o toglie la classe 'open' al contenitore (per mostrarlo/nasconderlo)
            container.classList.toggle('open');
            
            // Aggiunge o toglie la classe 'open' all'header (per ruotare la freccia)
            annataHeader.classList.toggle('open');
        }
    </script>

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
                <p>Sede legale: <a href="https://maps.app.goo.gl/9hHKLuXVx7wB1wM76" target="_blank">Piazza Dante 20, 38122 Trento (TN)</a></p>
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