<!-- START CONNECT TO DATABASE -->
<?php
try {
    $pdo = new PDO('mysql:dbname=garage_parrot;host=localhost;charset=utf8mb4', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    die('Erreur de connexion: ' . $e->getMessage());
}

// HACHAGE DU MOT DE PASSE DE L'ADMINISTRATEUR
$password = 'Vparrot31';
$motDePasseHache = password_hash($password, PASSWORD_BCRYPT);

// INSERTION DE L'ADMINISTRATEUR DANS TABLE USERS
$query = $pdo->prepare("INSERT INTO users (password_hash, email, nom, prenom, role) VALUES (:password_hash, :email, :nom, :prenom, :role)");
$query->execute(array(
    "password_hash" => $motDePasseHache,
    "email" => "Vincent.parrot@gmail.com",
    "nom" => "Parrot",
    "prenom" => "Vincent",
    "role" => "administrateur"
));

// MESSAGE CONFIRMATION D'INSERTION DE L'ADMINISTRATEUR
echo "L'administrateur a été ajouté avec succès dans la base de données.";

?>