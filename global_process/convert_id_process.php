<?php
// api_helper.php

// API-Konfiguration (in Produktivumgebung in .env auslagern)
const PELICAN_API_TOKEN = 'peli_5ToAkfHdrJjhaVWcjhOcTTdfZGDGCiJ3U6TgGugvKhj';
const PELICAN_API_URL = 'https://panel.pixel-network.de/api/application/users';

/**
 * Konvertiert externe User-ID zu interner Pterodactyl-ID
 *
 * @param int $external_id Externe ID aus lokaler DB
 * @return string|null Interne ID oder null bei Fehler
 * @throws Exception Bei API-Fehlern
 */
function convert_id(int $external_id): ?string {
    // 1. Schritt: Externe ID auflösen
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL            => PELICAN_API_URL . "/external/{$external_id}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => "",
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => "GET",
        CURLOPT_HTTPHEADER     => [
            "Accept: application/json",
            "Authorization: Bearer " . PELICAN_API_TOKEN
        ],
    ]);

    $response = curl_exec($curl);
    $error    = curl_error($curl);
    curl_close($curl);

    if ($error) {
        throw new Exception("API-Fehler beim Auflösen: $error");
    }

    // 2. Schritt: JSON verarbeiten
    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Ungültige JSON-Antwort: " . json_last_error_msg());
    }

    return $data['attributes']['id'] ?? null;
}