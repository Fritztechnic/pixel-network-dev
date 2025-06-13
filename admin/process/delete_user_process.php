<?php
session_start();

// Admin-Authentifizierung prüfen
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.html");
    exit();
}

// Datenbankverbindung herstellen
require '../../global_process/db_connect.php';

// Externe User-ID aus URL-Parameter holen
$external_id = intval($_GET['id']);

// API-Konfiguration
$auth_token = "peli_5ToAkfHdrJjhaVWcjhOcTTdfZGDGCiJ3U6TgGugvKhj";
$base_api_url = "https://panel.pixel-network.de/api/application/users";

try {
    // 1. Schritt: Externe ID auflösen
    $curl_get = curl_init();
    curl_setopt_array($curl_get, [
        CURLOPT_URL => "$base_api_url/external/$external_id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Bearer $auth_token"
        ],
    ]);

    $response_get = curl_exec($curl_get);
    $err_get = curl_error($curl_get);
    curl_close($curl_get);

    if ($err_get) {
        throw new Exception("API-Fehler beim Suchen: $err_get");
    }

    $data = json_decode($response_get, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Ungültige JSON-Antwort");
    }

    if (!isset($data['attributes']['id'])) {
        throw new Exception("Interne ID nicht gefunden");
    }

    $internal_id = $data['attributes']['id'];

    // 2. Schritt: User über API löschen
    $curl_delete = curl_init();
    curl_setopt_array($curl_delete, [
        CURLOPT_URL => "$base_api_url/$internal_id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Bearer $auth_token"
        ],
    ]);

    $response_delete = curl_exec($curl_delete);
    $err_delete = curl_error($curl_delete);
    curl_close($curl_delete);

    if ($err_delete) {
        throw new Exception("API-Fehler beim Löschen: $err_delete");
    }

    // 3. Schritt: Lokalen Benutzer löschen
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$external_id]);

    // Erfolgreich weiterleiten
    header("Location: ../dashboard.php?status=deleted");
    exit();

} catch (Exception $e) {
    // Fehlerbehandlung
    error_log("Löschfehler: " . $e->getMessage());
    header("Location: ../dashboard.php?error=" . urlencode($e->getMessage()));
    exit();
}