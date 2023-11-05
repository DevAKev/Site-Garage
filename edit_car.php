<?php
require_once __DIR__ . ('/lib/session.php');
adminOnly();
require_once('templates/header.php');

$id = $_GET['id'];
$car = getCarById($pdo, $id);

$errors = [];
$messages = [];

// GESTION DE LA SOUMISSION DU FORMULAIRE
if (isset($_POST['updateCar'])) {
    $marque = htmlspecialchars($_POST['marque'], ENT_QUOTES, 'UTF-8');
    $modele = htmlspecialchars($_POST['modele'], ENT_QUOTES, 'UTF-8');
    $prix = intval($_POST['prix']);
    $annee_mise_en_circulation = intval($_POST['annee_mise_en_circulation']);
    $kilometrage = intval($_POST['kilometrage']);
    $caracteristiques = htmlspecialchars($_POST['caracteristiques'], ENT_QUOTES, 'UTF-8');
    $equipements_options = htmlspecialchars($_POST['equipements_options'], ENT_QUOTES, 'UTF-8');
    $carburant = htmlspecialchars($_POST['carburant'], ENT_QUOTES, 'UTF-8');
    $image = isset($_FILES['image']) ? $_FILES['image'] : [];
    $galerie_images = isset($_FILES['galerie_images']) ? $_FILES['galerie_images'] : [];

    // VALIDATION DES CHAMPS
    require_once __DIR__ . ('/lib/validateFieldsCarForm.php');

    // SI PAS D'ERREURS
    if (empty($errors)) {
        $result = updateCar($pdo, $id, $_POST);
        if ($result) {
            // REDIRECTION EN CAS DE SUCCÈS
            echo '<script>window.location.href = "car.php?id=' . $id . '";</script>';
            exit();
        } else {
            $errors[] = 'Une erreur est survenue lors de la mise à jour de l\'annonce.';
        }
    }
}

// GESTION SUPPRESSION ANNONCE
if (isset($_POST['deleteCar'])) {
    $id = $_GET['id'];
    $result = deleteCar($pdo, $id);
    if ($result) {
        // REDIRECTION EN CAS DE SUCCÈS
        echo '<script>window.location.href = "ajouter_modifier_annonces.php";</script>';
        exit();
    } else {
        $errors[] = 'Une erreur est survenue lors de la suppression de l\'annonce.';
    }
}
?>

<!-- FORMULAIRE DE MODIFICATION D'ANNONCE -->
<?php require_once('templates/editCar_form.php'); ?>

<!-- SCRIPT POUR LE COMPTEUR DE TEXTE -->
<script src="assets/JS/text_counterCarForm.js"></script>

<!-- FOOTER -->
<?php require_once('templates/footer.php'); ?>