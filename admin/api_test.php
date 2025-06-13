<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>User-Management</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .result { margin-top: 20px; padding: 10px; background: #f0f0f0; border-radius: 5px; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
<h1>User-Informationen & Löschen</h1>

<form method="POST">
    <label>Externale User-ID:
        <input type="text" name="user_id" value="<?= htmlspecialchars($_POST['user_id'] ?? '') ?>" required>
    </label>
    <br><br>
    <label>Authorization Token:
        <input type="text" name="auth_token" value="<?= htmlspecialchars($_POST['auth_token'] ?? '') ?>" required>
    </label>
    <br><br>
    <button type="submit" name="submit">Suchen & Löschen</button>
</form>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <div class="result">
        <h2>Ergebnis:</h2>
        <?php
        // Eingaben sichern
        $user_id = $_POST['user_id'];
        $auth_token = $_POST['auth_token'];

        // 1. Schritt: Externe ID abrufen
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://panel.pixel-network.de/api/application/users/external/$user_id",
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

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "<div class='error'>cURL Error (GET): $err</div>";
        } else {
            $data = json_decode($response, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                echo "<div class='error'>Fehler beim Dekodieren der JSON-Antwort.</div>";
            } elseif (!isset($data['attributes']['id'])) {
                echo "<div class='error'>Benutzer-ID nicht gefunden.</div>";
            } else {
                $internal_id = $data['attributes']['id'];
                echo "<div class='success'>Gefundene Benutzer-ID: $internal_id</div>";

                // 2. Schritt: User löschen
                $curl_delete = curl_init();
                curl_setopt_array($curl_delete, [
                    CURLOPT_URL => "https://panel.pixel-network.de/api/application/users/$internal_id",
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

                $delete_response = curl_exec($curl_delete);
                $delete_err = curl_error($curl_delete);
                curl_close($curl_delete);

                if ($delete_err) {
                    echo "<div class='error'>cURL Error (DELETE): $delete_err</div>";
                } else {
                    echo "<div class='success'>User wurde erfolgreich gelöscht!</div>";
                    echo "<div>Löschantwort: $delete_response</div>";
                }
            }
        }
        ?>
    </div>
<?php endif; ?>
</body>
</html>