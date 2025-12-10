<?php
session_start();

// Controllo sicurezza
if (!isset($_SESSION['user_id']) || $_SESSION['ruolo'] !== 'admin') {
    header("Location: accedi.php");
    exit;
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['bollettino'])) {
    $anno = $_POST['anno'];
    $mese = $_POST['mese']; // Ora prendiamo il mese dalla select
    
    // Nome file standardizzato: bollettino-gennaio-2024.pdf
    $nomeFile = "bollettino-" . $mese . "-" . $anno . ".pdf";
    
    // Cartella di destinazione: ../Bollettini/2024
    $cartellaBase = "../Bollettini";
    $cartellaAnno = $cartellaBase . "/" . $anno;

    // Se non esiste la cartella "Bollettini", la crea
    if (!is_dir($cartellaBase)) mkdir($cartellaBase, 0777, true);
    // Se non esiste la cartella dell'anno (es. 2025), la crea
    if (!is_dir($cartellaAnno)) mkdir($cartellaAnno, 0777, true);
    
    $percorsoFinale = $cartellaAnno . "/" . $nomeFile;

    // Controllo che sia un PDF
    $estensione = strtolower(pathinfo($_FILES['bollettino']['name'], PATHINFO_EXTENSION));
    
    if($estensione === 'pdf') {
        if (move_uploaded_file($_FILES['bollettino']['tmp_name'], $percorsoFinale)) {
            $msg = "<p style='color:green; font-weight:bold;'>✅ Bollettino caricato con successo!</p>";
        } else {
            $msg = "<p style='color:red;'>❌ Errore nel caricamento del file.</p>";
        }
    } else {
        $msg = "<p style='color:red;'>⚠️ Puoi caricare solo file PDF.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Carica Bollettino</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        body { padding-top: 150px; text-align: center; background-color: #f9f9f9; }
        .admin-panel { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: left; }
        input, select { width: 100%; padding: 10px; margin: 5px 0 15px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        label { font-weight: bold; color: #E2457C; }
    </style>
</head>
<body>

    <div class="top-nav">
        <a href="area_riservata.php" style="font-weight: bold;">⬅ Torna alla Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="admin-panel">
        <h2 style="text-align: center; color: #E2457C;">Carica Nuovo Bollettino</h2>
        
        <?= $msg ?>

        <form method="POST" enctype="multipart/form-data">
            
            <label>Anno (es. 2025)</label>
            <input type="number" name="anno" required placeholder="Inserisci l'anno..." value="<?php echo date("Y"); ?>">

            <label>Mese</label>
            <select name="mese">
                <option value="gennaio">Gennaio</option>
                <option value="febbraio">Febbraio</option>
                <option value="marzo">Marzo</option>
                <option value="aprile">Aprile</option>
                <option value="maggio">Maggio</option>
                <option value="giugno">Giugno</option>
                <option value="luglio">Luglio</option>
                <option value="agosto">Agosto</option>
                <option value="settembre">Settembre</option>
                <option value="ottobre">Ottobre</option>
                <option value="novembre">Novembre</option>
                <option value="dicembre">Dicembre</option>
            </select>

            <label>File PDF</label>
            <input type="file" name="bollettino" accept=".pdf" required>

            <button type="submit" class="round-btn" style="width: 100%; margin-top: 10px;">Carica Bollettino</button>
        </form>
    </div>

</body>
</html>