<?php
require_once('templates/header.php');

$id = $_GET['id'];
$car = getCarById($pdo, $id);

// Vérifier si l'annonce avec l'ID donné existe
if (!$car) {
    header('Location: ajouter_modifier_annonces.php');
    exit();
}

$errors = [];
$messages = [];

// Gestion de la soumission du formulaire de modification
if (isset($_POST['updateCar'])) {
    // Effectuer les validations des champs et mettre à jour la base de données
    // ...

    // Afficher un message de succès ou d'erreur
    if (!$errors) {
        $messages[] = 'L\'annonce a été mise à jour avec succès !';
    } else {
        $errors[] = 'Une erreur est survenue lors de la mise à jour de l\'annonce.';
    }
}

// Gestion de la suppression de l'annonce
if (isset($_POST['deleteCar'])) {
    // Supprimer l'annonce de la base de données
    // ...

    // Afficher un message de succès ou d'erreur
    if (!$errors) {
        $messages[] = 'L\'annonce a été supprimée avec succès !';
    } else {
        $errors[] = 'Une erreur est survenue lors de la suppression de l\'annonce.';
    }
}
?>

<h1>Modifier l'annonce</h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success"><?= $message ?></div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php } ?>

<form method="POST">
    <!-- Afficher les champs pré-remplis avec les détails du véhicule à modifier -->
    <div class="mb-3">
        <label for="marque" class="form-label">Marque : *</label>
        <input type="text" name="marque" id="marque" class="form-control" value="<?= htmlentities($car['marque']); ?>">
    </div>
    <div class="mb-3">
        <label for="modele" class="form-label">Modèle : *</label>
        <input type="text" name="modele" id="modele" class="form-control" value="<?= htmlentities($car['modele']); ?>">
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix : *</label>
        <input type="number" name="prix" id="prix" class="form-control" value="<?= htmlentities($car['prix']); ?>">
    </div>
    <div class="mb-3">
        <label for="annee_mise_en_circulation" class="form-label">Année de mise en circulation : *</label>
        <input type="number" name="annee_mise_en_circulation" id="annee_mise_en_circulation" class="form-control" value="<?= htmlentities($car['annee_mise_en_circulation']); ?>">
    </div>
    <div class="mb-3">
        <label for="kilometrage" class="form-label">Kilométrage : *</label>
        <input type="number" name="kilometrage" id="kilometrage" class="form-control" value="<?= htmlentities($car['kilometrage']); ?>">
    </div>
    <div class="mb-3">
        <label for="caracteristiques" class="form-label">Caractéristiques : *</label>
        <textarea name="caracteristiques" id="caracteristiques" class="form-control"><?= htmlentities($car['caracteristiques']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="equipements_options" class="form-label">Equipements et options : *</label>
        <textarea name="equipements_options" id="equipements_options" class="form-control"><?= htmlentities($car['equipements_options']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="carburant" class="form-label">Carburant : *</label>
        <select name="carburant" id="carburant" class="form-select">
            <option value="essence" <?= $car['carburant'] === 'essence' ? 'selected' : '' ?>>Essence</option>
            <option value="diesel" <?= $car['carburant'] === 'diesel' ? 'selected' : '' ?>>Diesel</option>
            <option value="electrique" <?= $car['carburant'] === 'electrique' ? 'selected' : '' ?>>Electrique</option>
            <option value="hybride" <?= $car['carburant'] === 'hybride' ? 'selected' : '' ?>>Hybride</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image principale : *</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <div class="mb-3">
        <label for="galerie_images" class="form-label">Images : *</label>
        <input type="file" name="galerie_images[]" id="galerie_images" class="form-control" multiple>
    </div>
    <!-- Autres champs du formulaire de modification -->

    <input type="submit" value="Enregistrer les modifications" name="updateCar" class="btn btn-primary">
    <input type="submit" value="Supprimer l'annonce" name="deleteCar" class="btn btn-danger">
</form>

<?php require_once('templates/footer.php'); ?>