<?php
session_start();
require '../../global_process/db_connect.php';

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

$errors = [];

if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    $errors[] = "Alle Felder sind erforderlich.";
} elseif ($password !== $confirm_password) {
    $errors[] = "Passwörter stimmen nicht überein.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Ungültige E-Mail-Adresse.";
} else {
    try {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->rowCount() > 0) {
            $errors[] = "Benutzername oder E-Mail bereits vergeben.";
        }
    } catch (PDOException $e) {
        $errors[] = "Datenbankfehler: " . $e->getMessage();
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            // 1. Lokale Benutzereinfügung
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);
            $lastInsertId = $pdo->lastInsertId(); // Holen der letzten ID

            // 2. API-Aufruf für Pterodactyl-Benutzererstellung
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
                    'external_id' => $lastInsertId, // Verwende die lokale ID
                    'username' => $username,
                    'password' => $password, // Klartext-Passwort an die API senden
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

            // 3. Fehlerprotokollierung für API
            if ($err) {
                error_log("Pterodactyl API Error: " . $err);
            }

            // 4. Erfolgreich weiterleiten
            header("Location: ../login.php?success=1");
            exit();

        } catch (PDOException $e) {
            $errors[] = "Registrierung fehlgeschlagen: " . $e->getMessage();
        }
    }
}

$error_msg = implode("<br>", $errors);
header("Location: ../register.php?error=" . urlencode($error_msg));
exit();
