<!-- START CONNECT TO DATABASE -->
<?php
try {
    $pdo = new PDO('mysql:dbname=garage_parrot;host=localhost;charset=utf8mb4', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    die('Erreur de connexion: ' . $e->getMessage());
}

// HACHAGE DU MOT DE PASSE DE L'ADMINISTRATEUR
$password = 'Johndoe31';
$motDePasseHache = password_hash($password, PASSWORD_BCRYPT);

// INSERTION DE L'ADMINISTRATEUR DANS TABLE USERS
$query = $pdo->prepare("INSERT INTO users (password_hash, email, nom, prenom, role) VALUES (:password_hash, :email, :nom, :prenom, :role)");
$query->execute(array(
    "password_hash" => $motDePasseHache,
    "email" => "John.doe@gmail.com",
    "nom" => "Doe",
    "prenom" => "John",
    "role" => "employe"
));

// MESSAGE CONFIRMATION D'INSERTION DE L'EMLPOYE
echo "L'utilisateur a été ajouté avec succès dans la base de données.";

?>