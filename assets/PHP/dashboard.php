<?php

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage_parrot";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Vérification de l'authentification de l'administrateur
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Récupération des informations de l'administrateur connecté
$email = $_SESSION['email'];

// Requête pour obtenir les informations de l'administrateur
$sql = "SELECT * FROM administrateur WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nom = $row['nom'];
    $prenom = $row['prenom'];
} else {
    // Déconnexion de l'utilisateur si les informations ne peuvent pas être récupérées
    header("Location: logout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Referencement description -->
    <title>Dashboard - Garage V. Parrot</title>
    <!-- Les autres balises meta et les liens CSS -->
</head>
<body>
    <div class="container-fluid">
        <nav id="navbarMembre">
            <!-- Votre code HTML pour la navigation -->
        </nav>
        <div id="containerMembre" class="container">
            <h1> Bienvenue <?php echo $prenom . " " . $nom; ?> !</h1>
            <!-- Votre code HTML pour le contenu du dashboard administrateur -->
        </div>
    </div>

    <!-- Vos scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <script src="assets/JS/accueil-membre.js"></script>
</body>
</html>
