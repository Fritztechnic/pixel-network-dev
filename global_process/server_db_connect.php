<?php
// Datenbankverbindung mit PDO
$host = 'localhost';
$dbname = 'website_db';
$user = 'website_user';
$pass = 'Kirbissaft-01';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Datenbankverbindung fehlgeschlagen: ' . $e->getMessage());
}