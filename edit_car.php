<?php
require_once('templates/header.php');

$id = $_GET['id'];
$car = getCarById($pdo, $id);

$errors = [];
$messages = [];

// Gestion de la soumission du formulaire de modification
if (isset($_POST['updateCar'])) {
    $result = updateCar($pdo, $id, $_POST);
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $prix = $_POST['prix'];
    $annee_mise_en_circulation = $_POST['annee_mise_en_circulation'];
    $kilometrage = $_POST['kilometrage'];
    $caracteristiques = $_POST['caracteristiques'];
    $equipements_options = $_POST['equipements_options'];
    $carburant = $_POST['carburant'];
    $image = isset($_FILES['image']) ? $_FILES['image'] : [];
    $galerie_images = isset($_FILES['galerie_images']) ? $_FILES['galerie_images'] : [];

    if ($result) {
        // REDIRECTION
        echo '<script>window.location.href = "car.php?id=' . $id . '";</script>';
        exit();
    } else {
        $errors[] = 'Une erreur est survenue lors de la mise à jour de l\'annonce.';
    }
}

// GESTION SUPPRESSION ANNONCE
if (isset($_POST['deleteCar'])) {
    $id = $_GET['id'];
    $result = deleteCar($pdo, $id);
    if ($result) {
        // REDIRECTION
        echo '<script>window.location.href = "ajouter_modifier_annonces.php";</script>';
        exit();
    } else {
        $errors[] = 'Une erreur est survenue lors de la suppression de l\'annonce.';
    }
}
?>

<?php require_once('templates/editCar_form.php'); ?>
<?php require_once('templates/footer.php'); ?>