<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

// Benutzer-ID aus POST-Daten holen
$user_id = intval($_POST['user_id']);

// Neue Passwörter validieren
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($new_password) || empty($confirm_password)) {
    header("Location: ../reset_password.php?user_id=$user_id&error=Alle Felder sind erforderlich.");
    exit();
}

if ($new_password !== $confirm_password) {
    header("Location: ../reset_password.php?user_id=$user_id&error=Passwörter stimmen nicht überein.");
    exit();
}

// Datenbankverbindung herstellen
require '../../global_process/db_connect.php';

try {
    // Passwort hashen und in der DB speichern
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute([$hashed_password, $user_id]);

    // Erfolg: Zurück zum Dashboard
    header("Location: ../dashboard.php?success=Passwort erfolgreich geändert.");
    exit();
} catch (PDOException $e) {
    // Fehler: Zurück zur Reset-Seite mit Fehlermeldung
    error_log($e->getMessage());
    header("Location: ../reset_password.php?user_id=$user_id&error=Fehler beim Zurücksetzen des Passworts.");
    exit();
}