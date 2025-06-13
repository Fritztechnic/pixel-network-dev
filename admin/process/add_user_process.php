<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.html");
    exit();
}

require '../../global_process/db_connect.php';

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];

// Validierung
if (empty($username) || empty($email) || empty($password)) {
    header("Location: ../dashboard.php?error=Alle Felder sind erforderlich.");
    exit();
}
if (strlen($password) < 12) {
    header("Location: ../dashboard.php?error=Passwort muss mindestens 12 Zeichen haben.");
    exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../dashboard.php?error=Ungültige E-Mail-Adresse.");
    exit();
}

// Prüfen, ob Benutzername oder E-Mail bereits existiert
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->execute([$username, $email]);
if ($stmt->rowCount() > 0) {
    header("Location: ../dashboard.php?error=Benutzername oder E-Mail bereits vergeben.");
    exit();
}

// Benutzer erstellen
try {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashed_password]);
    $lastInsertId = $pdo->lastInsertId(); // Lokale Benutzer-ID holen

    // 🔧 Pterodactyl API Benutzererstellung
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://panel.pixel-network.de/api/application/users",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'email' => $email,
            'external_id' => $lastInsertId, // Verwende lokale ID als external_id
            'username' => $username,
            'password' => $password, // Klartext-Passwort an API senden
            'language' => 'en',
            'timezone' => 'Europe/Berlin'
        ]),
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Bearer peli_5ToAkfHdrJjhaVWcjhOcTTdfZGDGCiJ3U6TgGugvKhj",
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    // 🔍 Fehlerbehandlung für API
    if ($err) {
        error_log("Pterodactyl API Error: " . $err);
        // Optional: Admin benachrichtigen
        header("Location: ../dashboard.php?error=Pterodactyl-Benutzer konnte nicht erstellt werden.");
        exit();
    }

    // ✅ Erfolgreich weiterleiten
    header("Location: ../dashboard.php?success=1");
    exit();

} catch (PDOException $e) {
    error_log($e->getMessage());
    header("Location: ../dashboard.php?error=Fehler beim Erstellen des Benutzers.");
    exit();
}