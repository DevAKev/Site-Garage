<?php
require_once __DIR__ . ('/lib/session.php');
adminOnly();
require_once __DIR__ . ('/admin/templates/header.php');

$errors = [];
$messages = [];
$car = [
    'marque' => '',
    'modele' => '',
    'caracteristiques' => '',
    'equipements_options' => '',
];

// RECUPERER LES DONNEES DU FORMULAIRE AU CLICK "ENREGISTRER"
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

    $marque = htmlspecialchars($_POST['marque'], ENT_QUOTES, 'UTF-8');
    $modele = htmlspecialchars($_POST['modele'], ENT_QUOTES, 'UTF-8');
    $prix = intval($_POST['prix']);
    $annee_mise_en_circulation = intval($_POST['annee_mise_en_circulation']);
    $kilometrage = intval($_POST['kilometrage']);
    $caracteristiques = htmlspecialchars($_POST['caracteristiques'], ENT_QUOTES, 'UTF-8');
    $equipements_options = htmlspecialchars($_POST['equipements_options'], ENT_QUOTES, 'UTF-8');
    $carburant = htmlspecialchars($_POST['carburant'], ENT_QUOTES, 'UTF-8');
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
        $res = saveCar($pdo, $_POST['marque'], $_POST['modele'], $_POST['prix'], $image, $_POST['annee_mise_en_circulation'], $_POST['kilometrage'], $galerie_imagesString, $_POST['caracteristiques'], $_POST['equipements_options'], $_POST['carburant']);
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
        'marque' => $_POST['marque'],
        'modele' => $_POST['modele'],
        'caracteristiques' => $_POST['caracteristiques'],
        'equipements_options' => $_POST['equipements_options'],
    ];
}
?>
<br>
<h2><a href="cars.php">Voir les annonces</a></h2>
<h1 class="display-5 fw-bold text-body-emphasis">Ajouter une annonce</h1>

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

?>