<?php
session_start();
require 'config.php';
$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';
if ($email === ADMIN_EMAIL && $pass === ADMIN_PASSWORD) {
    $_SESSION['user_id'] = 1;
    $_SESSION['ruolo'] = 'admin';
    header("Location: area_riservata.php");
} else {
    header("Location: accedi.php?error=Credenziali errate");
}
?>