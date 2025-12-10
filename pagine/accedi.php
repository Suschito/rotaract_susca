<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Accedi</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body style="text-align:center; padding-top:50px;">
    <h2>Area Riservata</h2>
    <?php if (isset($_GET['error'])) echo "<p style='color:red'>".htmlspecialchars($_GET['error'])."</p>"; ?>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Accedi</button>
    </form>
    <br><a href="../index.html">Torna alla Home</a>
</body>
</html>