<?php
require_once('templates/header.php');

$id = $_GET['id'];
$car = getCarById($pdo, $id);

$errors = [];
$messages = [];

// Gestion de la soumission du formulaire de modification
if (isset($_POST['updateCar'])) {
    $result = updateCar($pdo, $id, $_POST);
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