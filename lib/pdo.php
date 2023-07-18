<!-- START CONNECT TO DATABASE -->
<?php
try {
    $pdo = new PDO('mysql:dbname=garage_parrot;host=localhost;charset=utf8mb4', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    die('Erreur de connexion: ' . $e->getMessage());
}
