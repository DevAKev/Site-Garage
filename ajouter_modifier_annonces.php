<?php
require_once __DIR__ . ('/lib/session.php');
adminOnly();
require_once __DIR__ . ('/admin/templates/header.php');

$errors = [];
$messages = [];
$car = [
    'marque' => '',
    'modele' => '',
    'prix' => '',
    'annee_mise_en_circulation' => '',
    'kilometrage' => '',
    'caracteristiques' => '',
    'equipements_options' => '',
];

// RECUPERER LES DONNEES DU FORMULAIRE AU CLICK "ENREGISTRER"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveCar'])) {
    $marque = htmlspecialchars($_POST['marque'], ENT_QUOTES, 'UTF-8');
    $modele = htmlspecialchars($_POST['modele'], ENT_QUOTES, 'UTF-8');
    $prix = intval($_POST['prix']);
    $annee_mise_en_circulation = intval($_POST['annee_mise_en_circulation']);
    $kilometrage = intval($_POST['kilometrage']);
    $caracteristiques = htmlspecialchars($_POST['caracteristiques'], ENT_QUOTES, 'UTF-8');
    $equipements_options = htmlspecialchars($_POST['equipements_options'], ENT_QUOTES, 'UTF-8');
    $carburant = htmlspecialchars($_POST['carburant'], ENT_QUOTES, 'UTF-8');

    // VALIDATION DES CHAMPS
    require_once __DIR__ . ('/lib/validateFieldsCarForm.php');

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

    // GERER LE TELECHARGEMENT DES IMAGES DE LA GALERIE
    $galerie_images = [];
    if (isset($_FILES['galerie_images']) && is_array($_FILES['galerie_images']['name']) && count($_FILES['galerie_images']['name']) > 0) {
        // LIMITE IMAGES GALERIE
        $maxGalleryImages = 3;
        // VERIFIER NOMBRE TOTAL DE FICHIERS TELECHARGES
        if (count($_FILES['galerie_images']['tmp_name']) > $maxGalleryImages) {
            $errors[] = 'Vous ne pouvez télécharger que ' . $maxGalleryImages . ' autres photos.';
        } else {
            // PARCOURIR TOUS LES FICHIERS TELECHARGES
            foreach ($_FILES['galerie_images']['tmp_name'] as $index => $tmpName) {
                if ($_FILES['galerie_images']['error'][$index] === UPLOAD_ERR_OK) {
                    // VERIFIER SI LE FICHIER EST UNE IMAGE
                    $checkImage = getimagesize($tmpName);
                    if ($checkImage !== false) {
                        // GENERER UN NOM UNIQUE POUR L'IMAGE
                        $imageName = uniqid() . '_' . slugify($_FILES['galerie_images']['name'][$index]);
                        // DEPLACER LE FICHIER VERS LE REPERTOIRE DE STOCKAGE
                        move_uploaded_file($tmpName, _GALERY_IMG_PATH_ . $imageName);
                        // AJOUTER LE NOM DE L'IMAGE AU TABLEAU GALERIE_IMAGES
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
        $res = saveCar($pdo, $marque, $modele, $prix, $image, $annee_mise_en_circulation, $kilometrage, $galerie_imagesString, $caracteristiques, $equipements_options, $carburant);
        // MESSAGE DE CONFIRMATION ET D'ERREUR
        if ($res) {
            $messages[] = 'Votre annonce a bien été enregistrée !';
            // OBTERNIR L'ID DU NOUVEAU VEHICULE CREE
            $newCarId = $pdo->lastInsertId();
            // REDIRECTION VERS LA PAGE DE L'ANNONCE NOUVELLEMENT CREEE
            echo '<script>window.location.href = "car.php?id=' . $newCarId . '";</script>';
            exit();
        } else {
            $errors[] = 'Une erreur est survenue lors de l\'enregistrement de votre annonce !';
        }
    }

    // N'EFFACE PAS LE CONTENU DES CHAMPS DU FORMULAIRE
    $car = [
        'marque' => $marque,
        'modele' => $modele,
        'caracteristiques' => $caracteristiques,
        'equipements_options' => $equipements_options,
        'prix' => $prix,
        'annee_mise_en_circulation' => $annee_mise_en_circulation,
        'kilometrage' => $kilometrage,
    ];
}
?>

<br>
<h2><a href="cars.php">Liste des annonces et modification</a></h2>
<h1 class="display-5 fw-bold text-body-emphasis">Ajouter une annonce</h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success"><?= $message ?>
    </div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"><?= $error ?>
    </div>
<?php } ?>

<!-- FORM START -->
<?php
require_once('templates/addCar_form.php');
?>

<!-- IMPORT SCRIPTS  -->
<script src="assets/JS/text_counterCarForm.js"></script>

<!-- FOOTER START -->
<?php
require_once('admin/templates/footer.php');
// FOOTER END
?>