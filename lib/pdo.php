<?php
require_once __DIR__ . "/config.php";
try {
    $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8mb4', DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    die('Erreur de connexion: ' . $e->getMessage());
}
