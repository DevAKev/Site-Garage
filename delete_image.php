<?php
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/session.php';
adminOnly();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $carId = intval($_GET['id']);

    // FETCH THE IMAGE FILENAME FROM THE DATABASE
    $query = $pdo->prepare('SELECT image FROM vehicules WHERE id = :id');
    $query->bindParam(':id', $carId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result && !empty($result['image'])) {
        // DELETE IMAGE FILE FROM FOLDER SERVER
        $filePath = _CARS_IMG_PATH_ . $result['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // UPDATE DATABASE WITH NULL VALUE FOR THE IMAGE
        $updateQuery = $pdo->prepare('UPDATE vehicules SET image = NULL WHERE id = :id');
        $updateQuery->bindParam(':id', $carId, PDO::PARAM_INT);
        $updateQuery->execute();

        // GO TO THE EDIT CAR PAGE AFTER DELETE
        header('Location: edit_car.php?id=' . $carId . '&success=Image supprimée avec succès');
        exit();
    } else {
        // GO TO THE EDIT CAR PAGE WITH ERROR MESSAGE
        header('Location: edit_car.php?id=' . $carId . '&error=Image non trouvée');
        exit();
    }
} else {
    // ERROR MESSAGE
    header('Location: edit_car.php?id=' . $carId . '&error=ID de voiture non valide');
    exit();
}

require_once('templates/footer.php');
