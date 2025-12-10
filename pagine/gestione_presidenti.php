<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    die("Accesso negato");
}

$year = intval($_POST['year']);
$name = trim($_POST['name']);
$confirm = isset($_POST['confirm']) ? $_POST['confirm'] : "no";
$delete = isset($_POST['delete']) ? $_POST['delete'] : "no";

// Controllo anno minimo
if ($year < 1985) {
    die("Errore: l'anno deve essere dal 1985 in poi.");
}

// Carico il JSON
$file = 'presidenti.json';
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// ELIMINAZIONE
if ($delete === "yes") {
    if (isset($data[$year])) {
        unset($data[$year]);
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
        echo "Eliminato";
        exit;
    }
    die("Anno inesistente.");
}

// Se esiste già un presidente per quell'anno
if (isset($data[$year]) && $confirm !== "yes") {
    echo "EXISTS"; 
    exit;
}

// SALVATAGGIO O MODIFICA
$data[$year] = $name;

// Riordino cronologicamente per sicurezza
ksort($data);

// Salvo
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

echo "OK";
?>
