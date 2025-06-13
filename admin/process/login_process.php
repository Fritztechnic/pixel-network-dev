<?php
session_start();
require '../../global_process/db_connect.php';

// Nur POST-Anfragen verarbeiten
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../login.php");
    exit();
}

$username = trim($_POST['username']);
$password = $_POST['password'];

// Benutzer suchen (Groß-/Kleinschreibung ignorieren)
$stmt = $pdo->prepare("SELECT id, username, password, is_admin FROM users WHERE LOWER(username) = LOWER(?)");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password']) && $user['is_admin']) {
    $_SESSION['admin_id'] = $user['id'];
    header("Location: ../dashboard.php");
    exit();
} else {
    $_SESSION['admin_username'] = $user['username'];
    header("Location: ../dashboard.php");
    exit();
    // Fehlermeldung kodieren und zurückleiten
    $errorMessage = urlencode("Ungültige Anmeldeinformationen oder keine Admin-Rechte.");
    header("Location: ../login.php?error=$errorMessage");
    exit();
}