<?php
session_start();

// Controllo sicurezza: Se non è admin, rimanda al login
if (!isset($_SESSION['user_id']) || $_SESSION['ruolo'] !== 'admin') {
    header("Location: accedi.php");
    exit;
}

// PERCORSI FILE JSON (Devono essere nella stessa cartella 'pagine')
$filePresidenti = 'presidenti.json';
$fileDirettivo = 'direttivo.json';

$msg = "";

function ordinaPresidenti($a, $b)
{
    return intval($a['anno']) - intval($b['anno']);
}
// --- CARICA DATI ATTUALI PRESIDENTI ---
$presidenti = file_exists($filePresidenti) ? json_decode(file_get_contents($filePresidenti), true) : [];


// --- LOGICA SALVATAGGIO NUOVO PRESIDENTE ---
if (isset($_POST['add_presidente']) || isset($_POST['conferma_modifica'])) {
    $anno = trim($_POST['anno']);
    $nome = trim($_POST['nome']);

    // Validazione anno: solo numeri e trattino
    if (preg_match('/^(\d{4})-(\d{4})$/', $anno, $matches)) {
    $anno_inizio = intval($matches[1]);
    $anno_fine = intval($matches[2]);

    if ($anno_inizio < 1985 || $anno_fine < $anno_inizio) {
        $msg = "Anno non valido. Dal 1985 in poi e secondo anno ≥ primo anno.";
    }elseif ($anno_fine !== $anno_inizio + 1) {
        $msg = "L'anno finale deve essere esattamente l'anno successivo a quello iniziale. Es: 2025-2026.";
    }
    // Validazione nome: solo lettere e spazi
    elseif (!preg_match('/^[a-zA-ZàèéìòùÀÈÉÌÒÙ\s]+$/', $nome)) {
        $msg = "Nome non valido. Usa solo lettere e spazi.";
    } else {
        // Controllo se l'anno esiste già
        $trovato = false;
        foreach ($presidenti as $index => $p) {
            if ($p['anno'] === $anno) {
                $trovato = $index;
                break;
            }
        }

        if ($trovato !== false) {
            if (isset($_POST['conferma_modifica'])) {
                $presidenti[$trovato]['nome'] = $nome;
                file_put_contents($filePresidenti, json_encode($presidenti, JSON_PRETTY_PRINT));
                $msg = "Presidente aggiornato con successo!";
            } else {
                $msg = "Presidente per $anno già esistente: {$presidenti[$trovato]['nome']}. Premi il pulsante di conferma per sostituirlo.";
                $confermaAnno = $anno;
                $confermaNome = $nome;
            }
        } else {
            $presidenti[] = ['anno' => $anno, 'nome' => $nome];
            file_put_contents($filePresidenti, json_encode($presidenti, JSON_PRETTY_PRINT));
            $msg = "Presidente aggiunto con successo!";
        }
    }
} else {
    $msg = "Formato anno non valido. Usa YYYY-YYYY.";
}
}

if (isset($_POST['elimina_presidente'])) {
    $anno_elimina = $_POST['anno_elimina'];
    foreach ($presidenti as $index => $p) {
        if ($p['anno'] === $anno_elimina) {
            array_splice($presidenti, $index, 1);
            file_put_contents($filePresidenti, json_encode($presidenti, JSON_PRETTY_PRINT));
            $msg = "Presidente dell'anno $anno_elimina eliminato con successo!";
            break;
        }
    }
}

// --- LOGICA AGGIORNAMENTO DIRETTIVO ---
if (isset($_POST['update_direttivo'])) {
    $ruoli = $_POST['ruolo'];
    $nomi = $_POST['nome_direttivo'];

    $nuovoDirettivo = [];
    for ($i = 0; $i < count($ruoli); $i++) {
        if (!empty($nomi[$i])) {
            $nuovoDirettivo[] = [
                'ruolo' => $ruoli[$i],
                'nome' => $nomi[$i]
            ];
        }
    }
    file_put_contents($fileDirettivo, json_encode($nuovoDirettivo, JSON_PRETTY_PRINT));
    $msg = "Direttivo aggiornato con successo!";
}

// Leggiamo i dati attuali
$direttivoAttuale = file_exists($fileDirettivo) ? json_decode(file_get_contents($fileDirettivo), true) : [
    ['ruolo' => 'Presidente', 'nome' => ''],
    ['ruolo' => 'Vice-Presidente', 'nome' => ''],
    ['ruolo' => 'Segretario', 'nome' => ''],
    ['ruolo' => 'Tesoriere', 'nome' => ''],
    ['ruolo' => 'Prefetto', 'nome' => ''],
    ['ruolo' => 'Past President', 'nome' => '']
];
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Gestione Chi Siamo</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        body {
            padding-top: 150px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .admin-panel {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        label {
            font-weight: bold;
            color: #E2457C;
        }

        .msg-success {
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        hr {
            border: 0;
            border-top: 1px solid #eee;
            margin: 30px 0;
        }
    </style>
</head>

<body>

    <div class="top-nav">
        <a href="area_riservata.php" style="font-weight: bold;">⬅ Torna alla Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="admin-panel">
        <h2 style="text-align: center;">Modifica Pagina "Chi Siamo"</h2>

        <?php if ($msg): ?>
            <p class="msg-success"><?= $msg ?></p>
        <?php endif; ?>

        <h3>1. Aggiungi o Modifica Presidente dall'albo</h3>
        <form method="POST">
            <label>Anno Rotaract (YYYY-YYYY)</label>
            <input type="text" name="anno" required placeholder="Es. 2025-2026" value="<?= $confermaAnno ?? '' ?>">

            <label>Nome e Cognome</label>
            <input type="text" name="nome" required placeholder="Inserisci il nome..."
                value="<?= $confermaNome ?? '' ?>">

            <?php if (!empty($confermaAnno) && !empty($confermaNome)): ?>
                <button type="submit" name="conferma_modifica" class="round-btn" style="width:100%">Conferma
                    Sostituzione</button>
            <?php else: ?>
                <button type="submit" name="add_presidente" class="round-btn" style="width:100%">Aggiungi
                    Presidente</button>
            <?php endif; ?>
        </form>
        <hr>
        <h3>2. Elimina Presidente</h3>
        <?php if (count($presidenti) > 0): ?>
            <form method="POST">
                <label>Seleziona anno da eliminare</label>
                <select name="anno_elimina" required>
                    <option value="">-- Scegli --</option>
                    <?php foreach ($presidenti as $p): ?>
                        <option value="<?= htmlspecialchars($p['anno']) ?>"><?= htmlspecialchars($p['anno']) ?> -
                            <?= htmlspecialchars($p['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="elimina_presidente" class="round-btn" style="width:100%">Elimina
                    Presidente</button>
            </form>
        <?php else: ?>
            <p>Nessun presidente presente da eliminare.</p>
        <?php endif;
        ?>
        <hr>

        <h3>3. Modifica Direttivo in Carica</h3>
        <p style="font-size: 0.9em; color: #666;">Modifica i nomi accanto ai ruoli e salva.</p>
        <form method="POST">
            <?php foreach ($direttivoAttuale as $membro): ?>
                <div style="margin-bottom: 10px;">
                    <label><?= htmlspecialchars($membro['ruolo']) ?></label>
                    <input type="hidden" name="ruolo[]" value="<?= htmlspecialchars($membro['ruolo']) ?>">
                    <input type="text" name="nome_direttivo[]" value="<?= htmlspecialchars($membro['nome']) ?>">
                </div>
            <?php endforeach; ?>
            <button type="submit" name="update_direttivo" class="round-btn" style="width:100%">Aggiorna
                Direttivo</button>
        </form>
    </div>
    <br><br>
</body>

</html>