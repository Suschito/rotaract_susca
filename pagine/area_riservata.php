<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['ruolo'] !== 'admin') {
    header("Location: accedi.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Area Riservata - Dashboard</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        body { padding-top: 150px; text-align: center; background-color: #f9f9f9; }
        .dashboard-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .btn-large {
            display: block;
            width: 80%;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="top-nav">
        <a href="area_riservata.php" class="active">Dashboard Admin</a>
        <a href="logout.php">Esci (Logout)</a>
    </div>

    <div class="dashboard-container">
        <h1 style="color: #E2457C;">Benvenuto Admin</h1>
        <p style="color: #555;">Seleziona cosa vuoi gestire oggi:</p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

        <a href="gestione_chisiamo.php" class="round-btn btn-large">
            ✏️ Modifica "Chi Siamo"
            <br><span style="font-size: 0.8em; font-weight: normal;">(Direttivo e Presidenti)</span>
        </a>

        <a href="upload_bollettino.php" class="round-btn btn-large">
            📂 Carica un Bollettino
            <br><span style="font-size: 0.8em; font-weight: normal;">(Carica PDF nell'archivio)</span>
        </a>
    </div>

</body>
</html>