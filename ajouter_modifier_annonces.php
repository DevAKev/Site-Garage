<?php

require_once('admin/templates/header.php');
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
    //SI UN FICHIER A ETE ENVOYE
    if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
        // VERIFIER SI LE FICHIER EST CHARGE
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
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
        } else {
            $errors[] = 'Une erreur est survenue lors du téléchargement de l\'image !';
        }
    } else {
        $image = '';
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
                if ($_FILES['galerie_images']['error'][$index] === UPLOAD_ERR_OK) {
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
                } else {
                    $errors[] = 'Une erreur est survenue lors du téléchargement de l\'image' . $_FILES['galerie_images']['name'][$index] . ' !';
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

<ul>
    <li><a href="ajouter_modifier_annonces.php">Ajouter une annonce</a></li>
    <li><a href="editCar.php">Modifier une annonce</a></li>
</ul>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success"><?= $message ?>
    </div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"><?= $error ?>
    </div>
<?php } ?>

<?php
require_once('templates/addCar_form.php');
?>

<!-- FOOTER START -->
<?php
require_once('admin/templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
require_once('lib/scripts.php');
?>