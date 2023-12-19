<?php
require_once __DIR__ . ('/lib/session.php');
adminOnly();
require_once __DIR__ . ('/admin/templates/header.php');

$errors = [];
$messages = [];
// DEFAULT VALUES FOR THE CAR FORM
$car = [
    'marque' => '',
    'modele' => '',
    'prix' => '',
    'annee_mise_en_circulation' => '',
    'kilometrage' => '',
    'caracteristiques' => '',
    'equipements_options' => '',
];

// FETCH FORM DATA WHEN 'saveCar' BUTTON IS CLICKED
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveCar'])) {
    // CLEAN & FETCH FORM DATA
    $marque = htmlspecialchars($_POST['marque'], ENT_QUOTES, 'UTF-8');
    $modele = htmlspecialchars($_POST['modele'], ENT_QUOTES, 'UTF-8');
    $prix = intval($_POST['prix']);
    $annee_mise_en_circulation = intval($_POST['annee_mise_en_circulation']);
    $kilometrage = intval($_POST['kilometrage']);
    $caracteristiques = htmlspecialchars($_POST['caracteristiques'], ENT_QUOTES, 'UTF-8');
    $equipements_options = htmlspecialchars($_POST['equipements_options'], ENT_QUOTES, 'UTF-8');
    $carburant = htmlspecialchars($_POST['carburant'], ENT_QUOTES, 'UTF-8');

    // VALIDATE FORM FIELDS
    require_once __DIR__ . ('/lib/validateFieldsCarForm.php');

    // IF UPLOAD MAIN IMAGE
    if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
        // CHECK IF THE FILE IS UPLOADED
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // GETIMAGESIZE RETURN FALSE IF FILE IS NOT AN IMAGE
            $checkImage = getimagesize($_FILES['image']['tmp_name']);
            // IF FILE IS AN IMAGE, PROCESS THE UPLOAD
            if ($checkImage !== false) {
                // GENERATE A UNIQUE NAME FOR THE MAIN IMAGE
                $image = uniqid() . '_' . slugify($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], _CARS_IMG_PATH_ . $image);
                // ERRORS MESSAGES
            } else {
                $errors[] = 'Le fichier doit être une image !';
            }
        } else {
            $errors[] = 'Une erreur est survenue lors du téléchargement de l\'image !';
        }
    } else {
        $image = '';
    }

    // MANAGE UPLOADED GALLERY IMAGES
    $galerie_images = [];
    if (isset($_FILES['galerie_images']) && is_array($_FILES['galerie_images']['name']) && count($_FILES['galerie_images']['name']) > 0) {
        // LIMIT GALLERY IMAGES
        $maxGalleryImages = 3;
        // CHECK TOTAL COUNT OF GALLERY IMAGES
        if (count($_FILES['galerie_images']['tmp_name']) > $maxGalleryImages) {
            $errors[] = 'Vous ne pouvez télécharger que ' . $maxGalleryImages . ' autres photos.';
        } else {
            // BROWSE UPLOADED GALLERY IMAGES
            foreach ($_FILES['galerie_images']['tmp_name'] as $index => $tmpName) {
                if ($_FILES['galerie_images']['error'][$index] === UPLOAD_ERR_OK) {
                    // CHECK IF THE FILE IS AN IMAGE
                    $checkImage = getimagesize($tmpName);
                    // IF FILE IS AN IMAGE, PROCESS THE UPLOAD
                    if ($checkImage !== false) {
                        // GENERATE A UNIQUE NAME FOR THE MAIN IMAGE
                        $imageName = uniqid() . '_' . slugify($_FILES['galerie_images']['name'][$index]);
                        // MOVE FILE TO THE GALLERY FOLDER
                        move_uploaded_file($tmpName, _GALERY_IMG_PATH_ . $imageName);
                        // ADD THE IMAGE NAME TO THE ARRAY
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
    // CONVERT THE ARRAY TO A STRING
    $galerie_imagesString = implode(',', $galerie_images);
    // IF NO ERRORS, SAVE THE CAR
    if (!$errors) {
        $res = saveCar($pdo, $marque, $modele, $prix, $image, $annee_mise_en_circulation, $kilometrage, $galerie_imagesString, $caracteristiques, $equipements_options, $carburant);
        // SUCCESS MESSAGE OR ERROR
        if ($res) {
            $messages[] = 'Votre annonce a bien été enregistrée !';
            // GET THE ID OF NEW CAR
            $newCarId = $pdo->lastInsertId();
            // GO TO THE CAR PAGE
            echo '<script>window.location.href = "car.php?id=' . $newCarId . '";</script>';
            exit();
        } else {
            $errors[] = 'Une erreur est survenue lors de l\'enregistrement de votre annonce !';
        }
    }

    // DO NOT CLEAR THE FORM FIELDS IF ERRORS
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

<h1 class="display-5 fw-bold text-body-emphasis">Ajouter une annonce</h1>
<h2 class="text-body-emphasis"><a href="cars.php">Voir les annonces et modifier</a></h2>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success"><?= $message ?>
    </div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"><?= $error ?>
    </div>
<?php } ?>

<!-- ADD CAR FORM START -->
<?php
require_once('templates/addCar_form.php');
?>

<!-- IMPORT SCRIPTS FOR TEXT COUNT -->
<script src="assets/JS/text_counterCarForm.js"></script>

<!-- FOOTER START -->
<?php
require_once('admin/templates/footer.php');
// FOOTER END
?>