<?php

require_once('templates/header.php');
// REDIRECTION
// if (isset($_SESSION['user'])) {
//     header('Location: Connexion.php');
// }

$errors = [];
$messages = [];
$car = [
    'marque' => '',
    'modele' => '',
    'caracteristiques' => '',
    'equipements_options' => '',
];

// Récupérer les données du formulaire au click "Enregistrer"
if (isset($_POST['saveCar'])) {
    $image = null;
    //SI UN FICHIER A ETE ENVOYE
    if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
        // GETIMAGESIZE VA RETOURNER FALSE SI LE FICHIER N'EST PAS UNE IMAGE
        $checkImage = getimagesize($_FILES['image']['tmp_name']);
        // SI LE FICHIER EST UNE IMAGE ON TRAITE L'UPLOAD
        if ($checkImage !== false) {
            $image = uniqid() . '_' . slugify($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], _CARS_IMG_PATH_ . $image);
            // SINON MESSAGE D'ERREUR
        } else {
            $errors[] = 'Le fichier doit être une image !';
        }
    }

    // INFORMATIONS OBLIGATOIRES POUR VALIDER LE FORMULAIRE
    if (isset($_POST['marque']) && !empty($_POST['marque'])) {
        $marque = $_POST['marque'];
    } else {
        $errors[] = 'La marque est obligatoire !';
    }
    if (isset($_POST['modele']) && !empty($_POST['modele'])) {
        $modele = $_POST['modele'];
    } else {
        $errors[] = 'Le modèle est obligatoire !';
    }
    if (isset($_POST['prix']) && !empty($_POST['prix'])) {
        $prix = $_POST['prix'];
    } else {
        $errors[] = 'Le prix est obligatoire !';
    }
    if (isset($_POST['annee_mise_en_circulation']) && !empty($_POST['annee_mise_en_circulation'])) {
        $annee_mise_en_circulation = $_POST['annee_mise_en_circulation'];
    } else {
        $errors[] = 'L\'année de mise en circulation est obligatoire !';
    }
    if (isset($_POST['kilometrage']) && !empty($_POST['kilometrage'])) {
        $kilometrage = $_POST['kilometrage'];
    } else {
        $errors[] = 'Le kilométrage est obligatoire !';
    }
    if (isset($_POST['caracteristiques']) && !empty($_POST['caracteristiques'])) {
        $caracteristiques = $_POST['caracteristiques'];
    } else {
        $errors[] = 'Les caractéristiques sont obligatoires !';
    }

    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $prix = $_POST['prix'];
    $annee_mise_en_circulation = $_POST['annee_mise_en_circulation'];
    $kilometrage = $_POST['kilometrage'];
    $caracteristiques = $_POST['caracteristiques'];
    $equipements_options = $_POST['equipements_options'];
    $carburant = $_POST['carburant'];

    // Gérer le téléchargement des images de la galerie
    $galerie_images = [];
    if (isset($_FILES['galerie_images']) && is_array($_FILES['galerie_images']['name']) && count($_FILES['galerie_images']['name']) > 0) {
        // Limite du nombre d'images de la galerie
        $maxGalleryImages = 3;
        // Vérifier le nombre total de fichiers téléchargés
        if (count($_FILES['galerie_images']['tmp_name']) > $maxGalleryImages) {
            $errors[] = 'Vous ne pouvez télécharger que ' . $maxGalleryImages . ' autres photos.';
        } else {
            // Parcourir tous les fichiers téléchargés
            foreach ($_FILES['galerie_images']['tmp_name'] as $index => $tmpName) {
                // Vérifier si le fichier est une image
                $checkImage = getimagesize($tmpName);
                if ($checkImage !== false) {
                    // Générer un nom unique pour l'image
                    $imageName = uniqid() . '_' . slugify($_FILES['galerie_images']['name'][$index]);
                    // Déplacer le fichier vers le répertoire de stockage
                    move_uploaded_file($tmpName, _GALERY_IMG_PATH_ . $imageName);
                    // Ajouter le nom de l'image à votre tableau galerie_images
                    $galerie_images[] = $imageName;
                } else {
                    $errors[] = 'Le fichier "' . $_FILES['galerie_images']['name'][$index] . '" doit être une image !';
                }
            }
        }
    }

    $galerie_imagesString = implode(',', $galerie_images);

    if (!$errors) {
        $res = saveCar($pdo, $_POST['marque'], $_POST['modele'], $_POST['prix'], $image, $_POST['annee_mise_en_circulation'], $_POST['kilometrage'], $galerie_imagesString, $_POST['caracteristiques'], $_POST['equipements_options'], $_POST['carburant']);
        // MESSAGE DE CONFIRMATION ET D'ERREUR
        if ($res) {
            $messages[] = 'Votre annonce a bien été enregistrée !';
            // Obtenir l'ID du nouveau véhicule créé
            $newCarId = $pdo->lastInsertId();

            // Redirection vers la nouvelle page du véhicule
            echo '<script>window.location.href = "car.php?id=' . $newCarId . '";</script>';
            exit();
        } else {
            $errors[] = 'Une erreur est survenue lors de l\'enregistrement de votre annonce !';
        }
    }

    // N'EFFACE PAS LE CONTENU DES CHAMPS DU FORMULAIRE
    $car = [
        'marque' => $_POST['marque'],
        'modele' => $_POST['modele'],
        'caracteristiques' => $_POST['caracteristiques'],
        'equipements_options' => $_POST['equipements_options'],
    ];
}
?>


<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae tenetur fuga ullam ad eaque at soluta asperiores, ipsam ratione reiciendis harum repellendus quibusdam minima illum ut velit quod quasi! Esse doloremque officia a mollitia eius, consequuntur quasi soluta suscipit at iste voluptates animi exercitationem voluptate tempore itaque, harum impedit inventore modi sed ad omnis ea. Nam, repellendus! Vero maiores sint, quod a commodi eveniet porro quae? Totam animi eius nobis, laborum corporis commodi rem cumque quasi, accusamus facilis cum exercitationem ut assumenda perferendis. Enim itaque nemo officia, pariatur beatae, ab quibusdam harum laudantium quidem incidunt totam. Dolor deserunt nisi, earum aliquid facilis perferendis amet autem, distinctio corrupti laboriosam maxime, asperiores voluptatem a ullam quae repellendus! Cupiditate quis itaque cum porro, perferendis quidem sapiente possimus cumque nesciunt praesentium quos asperiores voluptas quibusdam necessitatibus sequi alias voluptates nisi. Totam, eveniet dolorum. Nesciunt qui sunt similique cum cupiditate earum ipsa molestias beatae debitis nulla? Veritatis modi qui autem consequatur deserunt tempora inventore quam sint, delectus nesciunt sapiente aliquam quas repudiandae totam est praesentium iusto corporis sunt similique? Laborum exercitationem tenetur nulla quos quo soluta assumenda distinctio blanditiis. Eaque facilis ipsum, dolores, iure minima inventore ab voluptatibus quisquam dolore id ullam obcaecati omnis maiores?</p>

<h1>Ajouter une annonce</h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success"><?= $message ?>
    </div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"><?= $error ?>
    </div>
<?php } ?>

<!-- FORM START -->
<form method="POST" enctype="multipart/form-data">
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
        <input type="number" name="prix" id="prix"> €
    </div>
    <div class="mb-3">
        <label for="annee_mise_en_circulation">Année : *</label>
        <input type="number" name="annee_mise_en_circulation" id="annee_mise_en_circulation">
    </div>
    <div class="mb-3">
        <label for="kilometrage">Kilométrage : *</label>
        <input type="number" name="kilometrage" id="kilometrage">
    </div>
    <div class="mb-3">
        <label for="caracteristiques" class="form-label">Caracteristiques : *</label>
        <textarea name="caracteristiques" id="caracteristiques" cols="30" rows="5" class="form-control"><?= htmlentities($car['caracteristiques']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="equipements_options" class="form-label">Options du véhicule : </label>
        <textarea name="equipements_options" id="equipements_options" cols="10" rows="5" class="form-control"><?= htmlentities($car['equipements_options']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="carburant" class="form-label">Carburant : </label>
        <select name="carburant" id="carburant" class="form-select">
            <option value="Essence">Essence</option>
            <option value="Diesel">Diesel</option>
            <option value="Electrique">Electrique</option>
            <option value="Hybride">Hybride</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Photo Principale : </label>
        <input type="file" name="image" id="image">
    </div>
    <div class="mb-3">
        <label for="galerie_images" class="form-label">Autres Photos (maximum 3) :</label>
        <input type="file" name="galerie_images[]" id="galerie_images" accept="image/*" multiple>
    </div>
    <br>
    <input type="submit" value="Enregistrer" name="saveCar" class="btn btn-primary">
</form>

<!-- FOOTER START -->
<?php
require_once('templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
require_once('lib/scripts.php');
?>