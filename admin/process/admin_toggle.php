<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

require '../../global_process/db_connect.php';
require '../../global_process/convert_id_process.php';

// Überprüfen, ob id und action Parameter gesetzt sind
if (!isset($_GET['id']) || !isset($_GET['action'])) {
    header("Location: ../dashboard.php");
    exit();
}

$target_id = intval($_GET['id']);
$action = $_GET['action'];
$internal_id = convert_id($target_id);

// Prüfen, ob Zielbenutzer existiert
$stmt = $pdo->prepare("SELECT id, is_admin FROM users WHERE id = ?");
$stmt->execute([$target_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Benutzer existiert nicht
    header("Location: ../dashboard.php");
    exit();
}

// Aktion ausführen
if ($action === 'promote') {
    // Benutzer zum Admin machen
    $stmt = $pdo->prepare("UPDATE users SET is_admin = 1 WHERE id = ?");
    $stmt->execute([$target_id]);


    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://panel.pixel-network.de/api/application/users/8/roles/assign",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PATCH",
        CURLOPT_POSTFIELDS => json_encode([
            'roles' => [
                2
            ]
        ]),
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: Bearer plcn_pMcvyyLocRrFBcOZ0d14nBG68dETGaCvycNzhSuBeg5",
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
    header("Location: ../dashboard.php");
    exit();
} elseif ($action === 'demote') {
    // Prüfen, ob Zielbenutzer ein Admin ist
    if ($user['is_admin'] === 0) {
        header("Location: ../dashboard.php");
        exit();
    }

    // Prüfen, ob Admin sich selbst herabstufen will
    if ($target_id === $_SESSION['admin_id']) {
        header("Location: ../dashboard.php?error=" . urlencode("Du kannst dich nicht selbst herabstufen."));
        exit();
    }

    // Admin-Rechte entfernen
    $stmt = $pdo->prepare("UPDATE users SET is_admin = 0 WHERE id = ?");
    $stmt->execute([$target_id]);
    header("Location: ../dashboard.php");
    exit();
} else {
    // Ungültige Aktion
    header("Location: ../dashboard.php");
    exit();
}