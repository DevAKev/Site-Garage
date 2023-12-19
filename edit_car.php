<?php
require_once __DIR__ . '/lib/session.php';
adminOnly();
require_once('templates/header.php');

$id = $_GET['id'];
$car = getCarById($pdo, $id);

$errors = [];
$messages = [];

// MANAGING FORM SUBMISSION
if (isset($_POST['updateCar'])) {
    $marque = htmlspecialchars($_POST['marque'], ENT_QUOTES, 'UTF-8');
    $modele = htmlspecialchars($_POST['modele'], ENT_QUOTES, 'UTF-8');
    $prix = intval($_POST['prix']);
    $annee_mise_en_circulation = intval($_POST['annee_mise_en_circulation']);
    $kilometrage = intval($_POST['kilometrage']);
    $caracteristiques = htmlspecialchars($_POST['caracteristiques'], ENT_QUOTES, 'UTF-8');
    $equipements_options = htmlspecialchars($_POST['equipements_options'], ENT_QUOTES, 'UTF-8');
    $carburant = htmlspecialchars($_POST['carburant'], ENT_QUOTES, 'UTF-8');
    $image = $_FILES['image'] ?? null;
    $galerieImages = [];

    // FIELDS VALIDATION
    require_once __DIR__ . ('/lib/validateFieldsCarForm.php');

    // MAIN IMAGE MANAGEMENT
    // PROCESS THE DELETION OF THE MAIN IMAGE
    $deleteImage = isset($_POST['deleteImage']) ? true : false;
    // // IF USER SENT A NEW IMAGE
    $newImage = isset($_FILES['image']) ? $_FILES['image'] : [];
    if ($deleteImage) {
        // DELETE MAIN IMAGE
        deleteCarImage($pdo, $id);
    } elseif (!empty($newImage['tmp_name'])) {
        // CHECK IF THE FILE IS UPLOADED
        if ($newImage['error'] === UPLOAD_ERR_OK) {
            // GETIMAGESIZE RETURN FALSE IF FILE IS NOT AN IMAGE
            $checkImage = getimagesize($newImage['tmp_name']);
            // IF FILE IS AN IMAGE, PROCESS THE UPLOAD
            if ($checkImage !== false) {
                $image = uniqid() . '_' . slugify($newImage['name']);
                move_uploaded_file($newImage['tmp_name'], _CARS_IMG_PATH_ . $image);
                //MAJ BDD 
                $updateImageQuery = $pdo->prepare('UPDATE vehicules SET image = :image WHERE id = :id');
                $updateImageQuery->bindParam(':image', $image, PDO::PARAM_STR);
                $updateImageQuery->bindParam(':id', $id, PDO::PARAM_INT);
                $updateImageQuery->execute();
                // ERRORS MESSAGES
            } else {
                $errors[] = 'Le fichier doit être une image !';
            }
        } else {
            $errors[] = 'Une erreur est survenue lors du téléchargement de l\'image !';
        }
    } else {
        $image = $car['image'];
    }
    // GESTION DE LA GALERIE D'IMAGES
    // PROCESS THE DELETION OF THE GALLERY IMAGE 
    $deleteGaleryImage = isset($_POST['deleteGaleryImage']) ? true : false;
    // IF USER SENT NEW GALLERY IMAGES
    $newGaleryImages = isset($_FILES['galerie_images']) ? $_FILES['galerie_images'] : [];

    if ($deleteGaleryImage) {
        // DELETE GALLERY IMAGE
        deleteCarImageGalery($pdo, $id);
    } elseif (!empty($newGaleryImages['tmp_name'][0])) {
        // CHECK IF THE FILE IS UPLOADED
        foreach ($newGaleryImages['tmp_name'] as $key => $tmpName) {
            // CHECK IF THE FILE IS IMAGE
            $checkImage = getimagesize($tmpName);
            // IF FILE IS AN IMAGE, PROCESS UPLOAD
            if ($checkImage !== false) {
                // GENERATE UNIQUE FILENAME
                $galerieImage = uniqid() . '_' . slugify($newGaleryImages['name'][$key]);
                // MOVE FILE TO THE GALLERY FOLDER
                move_uploaded_file($tmpName, _GALERY_IMG_PATH_ . $galerieImage);
                // ADD FILENAME TO THE ARRAY
                $galerieImages[] = $galerieImage;
            } else {
                // ERRORS MESSAGES
                $errors[] = 'Le fichier "' . $newGaleryImages['name'][$key] . '" doit être une image !';
            }
        }
        // UPDATE DATABASE WITH NEW FILENAMES IN THE GALLERY
        $galerieImagesString = implode(',', $galerieImages);
        $updateGaleryImagesQuery = $pdo->prepare('UPDATE vehicules SET galerie_images = :galerie_images WHERE id = :id');
        $updateGaleryImagesQuery->bindParam(':galerie_images', $galerieImagesString, PDO::PARAM_STR);
        $updateGaleryImagesQuery->bindParam(':id', $id, PDO::PARAM_INT);
        $updateGaleryImagesQuery->execute();
    } else {
        // IF NO NEW GALLERY IMAGES, KEEP THE OLD FILENAMES
        $galerieImages = $car['galerie_images'];
    }

    // IF NO ERRORS, UPDATE THE DATABASE
    if (empty($errors)) {
        $result = updateCar($pdo, $id, $_POST);
        if ($result) {
            // GO TO THE MODIFIED CAR PAGE
            echo '<script>window.location.href = "car.php?id=' . $id . '";</script>';
            exit();
        } else {
            $errors[] = 'Une erreur est survenue lors de la mise à jour de l\'annonce.';
        }
    }
}

// MANAGING CAR DELETION
if (isset($_POST['deleteCar'])) {
    $id = $_GET['id'];
    $result = deleteCar($pdo, $id);
    if ($result) {
        // GO TO THE ADD CAR PAGE
        echo '<script>window.location.href = "/add_car.php";</script>';
        exit();
    } else {
        $errors[] = 'Une erreur est survenue lors de la suppression de l\'annonce.';
    }
}

if ($car['image'] !== null) {
    $imageUrl = htmlspecialchars(getCarImage($car['image']), ENT_QUOTES, 'UTF-8');
} else {
    // DEFAULT URL
    $imageUrl = '';
}
?>

<!-- EDIT CAR FORM -->
<?php include_once('templates/editCar_form.php'); ?>

<!-- SCRIPT TEXT COUNTER -->
<script src="assets/JS/text_counterCarForm.js"></script>

<!-- FOOTER -->
<?php require_once('templates/footer.php'); ?>