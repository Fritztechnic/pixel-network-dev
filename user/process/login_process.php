<?php
session_start();
require '../../global_process/db_connect.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    header("Location: ../login.php?error=" . urlencode("Bitte alle Felder ausfüllen."));
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../dashboard.php");
        exit();
    } else {
        header("Location: ../login.php?error=" . urlencode("Ungültiger Benutzername oder Passwort."));
        exit();
    }
} catch (PDOException $e) {
    header("Location: ../login.php?error=" . urlencode("Datenbankfehler: " . $e->getMessage()));
    exit();
}

