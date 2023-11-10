<?php
require_once __DIR__ . '/lib/session.php';
require_once __DIR__ . '/lib/pdo.php';
adminOnly();

if (isset($_GET['id']) && isset($_GET['image'])) {
    $id = $_GET['id'];
    $image = $_GET['image'];

    // DELETE IMAGE FILE FROM FOLDER SERVER
    $filePath = _GALERY_IMG_PATH_ . $image;
    if (file_exists($filePath)) {
        unlink($filePath);

        // UPDATE DATABASE BY DELETE THE FILENAME FROM THE GALLERY IMAGES
        $query = $pdo->prepare('SELECT galerie_images FROM vehicules WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result && !empty($result['galerie_images'])) {
            $galerieImages = explode(',', $result['galerie_images']);
            $galerieImages = array_diff($galerieImages, [$image]);
            $galerieImagesString = implode(',', $galerieImages);

            $updateQuery = $pdo->prepare('UPDATE vehicules SET galerie_images = :galerie_images WHERE id = :id');
            $updateQuery->bindParam(':galerie_images', $galerieImagesString, PDO::PARAM_STR);
            $updateQuery->bindParam(':id', $id, PDO::PARAM_INT);
            $updateQuery->execute();

            // GO TO THE EDIT CAR PAGE AFTER DELETE
            header('Location: edit_car.php?id=' . $id . '&success=Galerie d\'images supprimée avec succès');
            exit();
        } else {
            // GO TO THE EDIT CAR PAGE WITH ERROR MESSAGE
            header('Location: edit_car.php?id=' . $id . '&error=Galerie d\'images non trouvée');
            exit();
        }
    }
}
