<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage_parrot";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Fonction pour créer un compte administrateur
function createAdminAccount($nom, $prenom, $email, $role, $password) {
    global $conn;
    $sql = "INSERT INTO administrateur (nom, prenom, email, role, password) VALUES ('$nom', '$prenom', '$email', '$role', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Le compte administrateur a été créé avec succès.";
    } else {
        echo "Erreur lors de la création du compte administrateur : " . $conn->error;
    }
}

// Fonction pour créer un compte employé
function createEmployeeAccount($nom, $prenom, $email, $role, $password) {
    global $conn;
    $sql = "INSERT INTO employes (nom, prenom, email, role, password) VALUES ('$nom', '$prenom', '$email', '$role', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Le compte employé a été créé avec succès.";
    } else {
        echo "Erreur lors de la création du compte employé : " . $conn->error;
    }
}

// Fonction pour modifier les informations de contact
function updateContactInfo($nom, $email, $telephone) {
    global $conn;
    $sql = "UPDATE administrateur SET email='$email', telephone='$telephone' WHERE nom='$nom'";
    if ($conn->query($sql) === TRUE) {
        echo "Les informations de contact ont été mises à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour des informations de contact : " . $conn->error;
    }
}

// Fonction pour modifier les horaires d'ouverture
function updateOpeningHours($jour, $horaireOuverture, $horaireFermeture) {
    global $conn;
    $sql = "UPDATE administrateur SET horaire_ouverture='$horaireOuverture', horaire_fermeture='$horaireFermeture' WHERE jour='$jour'";
    if ($conn->query($sql) === TRUE) {
        echo "Les horaires d'ouverture ont été mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour des horaires d'ouverture : " . $conn->error;
    }
}

// Fonction pour ajouter une annonce de véhicule
function addVehicleListing($marque, $modele, $annee, $prix) {
    global $conn;
    $sql = "INSERT INTO annonces_vehicules (marque, modele, annee, prix) VALUES ('$marque', '$modele', '$annee', '$prix')";
    if ($conn->query($sql) === TRUE) {
        echo "L'annonce de véhicule a été ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'annonce de véhicule : " . $conn->error;
    }
}

// Fonction pour supprimer une annonce de véhicule
function deleteVehicleListing($id) {
    global $conn;
    $sql = "DELETE FROM annonces_vehicules WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "L'annonce de véhicule a été supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'annonce de véhicule : " . $conn->error;
    }
}

// Fonction pour modifier une annonce de véhicule
function updateVehicleListing($id, $marque, $modele, $annee, $prix) {
    global $conn;
    $sql = "UPDATE annonces_vehicules SET marque='$marque', modele='$modele', annee='$annee', prix='$prix' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "L'annonce de véhicule a été mise à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de l'annonce de véhicule : " . $conn->error;
    }
}

// Exemples d'utilisation des fonctions

// Créer un compte administrateur
createAdminAccount("Parrot", "Vincent", "vincent.parrot@gmail.com", "administrateur", password_hash("Vparrot31", PASSWORD_DEFAULT));

// Créer un compte employé
createEmployeeAccount("Doe", "John", "john.doe@example.com", "employé", password_hash("Johndoe123", PASSWORD_DEFAULT));

// Modifier les informations de contact
updateContactInfo("Parrot", "vincent.parrot@gmail.com", "0123456789");

// Modifier les horaires d'ouverture
updateOpeningHours("Lundi", "09:00", "18:00");

// Ajouter une annonce de véhicule
addVehicleListing("Renault", "Clio", 2019, 12000);

// Supprimer une annonce de véhicule
deleteVehicleListing(1);

// Modifier une annonce de véhicule
updateVehicleListing(2, "Peugeot", "308", 2018, 15000);

// Fermer la connexion à la base de données
$conn->close();
?>
