<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: accedi.php?error=Devi accedere");
    exit;
}

if ($_SESSION['ruolo'] !== 'admin') {
    die("Accesso negato: non hai permessi.");
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Carica Bollettino</title>
</head>
<body>

<h2>Carica nuovo bollettino</h2>

<form action="upload_bollettino.php" method="POST" enctype="multipart/form-data">

    <label>Anno</label>
    <input type="number" name="anno" required>

    <label>Mese</label>
    <select name="mese" required>
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

    <label>PDF Bollettino</label>
    <input type="file" name="bollettino" accept="application/pdf" required>

    <button type="submit">Carica</button>
</form>

</body>
</html>
