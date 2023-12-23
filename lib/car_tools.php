<?php
// FUNCTION FETCH ALL CARS BASED ON ID 
function getCarById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM vehicules WHERE id=:id');
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}

// SHOWS DATABASE IMAGE OR DEFAULT IMAGE
function getCarImage(string $image)
{
    if ($image === null || $image === '') {
        return 'assets/images/default_car_image.jpg';
    } else {
        return 'uploads/cars/' . $image;
    }
}
// FETCH ALL CARS FROM DATABASE & SHOWS RANDOMLY ON HOME PAGE(ALEATOIRE AFFICHANT AUSSI LES ID RECENTS)
function getCars(PDO $pdo, int $limit = null)
{
    $sql = 'SELECT * FROM vehicules ORDER BY RAND() DESC';
    if ($limit) {
        $sql .= ' LIMIT :limit';
    }
    $query = $pdo->prepare($sql);
    if ($limit) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }
    $query->execute();
    return $query->fetchAll();
}

// FETCH FORM DATA OF ADD CAR FORM
function saveCar(PDO $pdo, string $marque, string $modele, float $prix, string $image, int $annee_mise_en_circulation, int $kilometrage, string $galerie_images, string $caracteristiques, string $equipements_options, string $carburant)
{
    $sql = "INSERT INTO `vehicules` (`id`, `marque`, `modele`, `prix`, `image`, `annee_mise_en_circulation`, `kilometrage`, `galerie_images`, `caracteristiques`, `equipements_options`, `carburant`) VALUES (NULL, :marque, :modele, :prix, :image, :annee_mise_en_circulation, :kilometrage, :galerie_images, :caracteristiques, :equipements_options, :carburant)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':marque', $marque, PDO::PARAM_STR);
    $query->bindParam(':modele', $modele, PDO::PARAM_STR);
    $query->bindParam(':prix', $prix, PDO::PARAM_STR);
    $query->bindParam(':image', $image, PDO::PARAM_STR);
    $query->bindParam(':annee_mise_en_circulation', $annee_mise_en_circulation, PDO::PARAM_INT);
    $query->bindParam(':kilometrage', $kilometrage, PDO::PARAM_INT);
    $query->bindParam(':galerie_images', $galerie_images, PDO::PARAM_STR);
    $query->bindParam(':caracteristiques', $caracteristiques, PDO::PARAM_STR);
    $query->bindParam(':equipements_options', $equipements_options, PDO::PARAM_STR);
    $query->bindParam(':carburant', $carburant, PDO::PARAM_STR);
    return $query->execute();
}

// RETOUR A LA LIGNE TABLEAUX CARACTS ET EQUIPEMENTS
function linesToArray(string $string)
{
    return explode(PHP_EOL, $string);
}

// MODIFIE LE NOM DES IMAGES LORS DE L'ENREGISTREMENT (ENLEVE LES ESPACES ET LES CARACTERES SPECIAUX)
function slugify($text, string $divider = '-')
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, $divider);
    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);
    // lowercase
    $text = strtolower($text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

// FUNCTION UPDATE CAR
function updateCar(PDO $pdo, int $id, array $data)
{
    $query = $pdo->prepare('UPDATE vehicules SET marque = :marque, modele = :modele, prix = :prix, annee_mise_en_circulation = :annee, kilometrage = :kilometrage, carburant = :carburant, caracteristiques = :caracteristiques, equipements_options = :equipements WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':marque', $data['marque'], PDO::PARAM_STR);
    $query->bindParam(':modele', $data['modele'], PDO::PARAM_STR);
    $query->bindParam(':prix', $data['prix'], PDO::PARAM_INT);
    $query->bindParam(':annee', $data['annee_mise_en_circulation'], PDO::PARAM_INT);
    $query->bindParam(':kilometrage', $data['kilometrage'], PDO::PARAM_INT);
    $query->bindParam(':carburant', $data['carburant'], PDO::PARAM_STR);
    $query->bindParam(':caracteristiques', $data['caracteristiques'], PDO::PARAM_STR);
    $query->bindParam(':equipements', $data['equipements_options'], PDO::PARAM_STR);
    return $query->execute();
}

// function addCarImageToGalery(PDO $pdo, int $carId, array $newImages)
// {
//     // Récupération des noms des images actuelles dans la galerie
//     $query = $pdo->prepare('SELECT galerie_images FROM vehicules WHERE id = :id');
//     $query->bindParam(':id', $carId, PDO::PARAM_INT);
//     $query->execute();
//     $result = $query->fetch(PDO::FETCH_ASSOC);

//     $galerieImages = [];
//     if ($result && !empty($result['galerie_images'])) {
//         $galerieImages = explode(',', $result['galerie_images']);
//     }

//     // Traitement des nouvelles images
//     foreach ($newImages['tmp_name'] as $key => $tmpName) {
//         // Vérification si le fichier est une image
//         $checkImage = getimagesize($tmpName);
//         if ($checkImage !== false) {
//             $galerieImage = uniqid() . '_' . slugify($newImages['name'][$key]);
//             move_uploaded_file($tmpName, _GALERY_IMG_PATH_ . $galerieImage);
//             $galerieImages[] = $galerieImage;
//         } else {
//             // Gérer l'erreur si le fichier n'est pas une image
//             return false;
//         }
//     }

//     // Mettre à jour la base de données avec les noms des images de la galerie
//     $galerieImagesString = implode(',', $galerieImages);
//     $updateGaleryImagesQuery = $pdo->prepare('UPDATE vehicules SET galerie_images = :galerie_images WHERE id = :id');
//     $updateGaleryImagesQuery->bindParam(':galerie_images', $galerieImagesString, PDO::PARAM_STR);
//     $updateGaleryImagesQuery->bindParam(':id', $carId, PDO::PARAM_INT);
//     $updateGaleryImagesQuery->execute();

//     return true;
// }

// FUNCTION DELETE CAR
function deleteCar(PDO $pdo, int $id)
{
    $query = $pdo->prepare('DELETE FROM vehicules WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    return $query->execute();
}

// FUNCTION DELETE MAIN IMAGE
function deleteCarImage(PDO $pdo, int $id)
{
    // RECUPERER LE NOM DU FICHIER IMAGE A SUPPRIMER DEPUIS LA BDD
    $query = $pdo->prepare('SELECT image FROM vehicules WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    // SI RESULTAT ET IMAGE NON VIDE
    if ($result && !empty($result['image'])) {
        // SUPPRESSION PHYSIQUE DU FICHIER IMAGE DU SERVEUR
        $filePath = _CARS_IMG_PATH_ . $result['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        // MAJ DE LA BDD ET NULL SI PAS D'IMAGE
        $updateQuery = $pdo->prepare('UPDATE vehicules SET image = NULL WHERE id = :id');
        $updateQuery->bindParam(':id', $id, PDO::PARAM_INT);
        $updateQuery->execute();
        // REUSSITE DE LA SUPPRESSION
        return true;
    }
    // ECHEC DE LA SUPPRESSION
    return false;
}

// FUNCTION DELETE GALLERY IMAGE
function deleteCarImageGalery(PDO $pdo, int $carId)
{
    // RECUPERATION DES NOMS DES IMAGES DE LA GALERIE DANS LA BASE DE DONNEES
    $query = $pdo->prepare('SELECT galerie_images FROM vehicules WHERE id = :id');
    $query->bindParam(':id', $carId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result && !empty($result['galerie_images'])) {
        // SUPPRIMER LES FICHIERS PHYSIQUEMENT DU SERVEUR
        $galerieImages = isset($result['galerie_images']) ? explode(',', $result['galerie_images']) : [];
        foreach ($galerieImages as $image) {
            $filePath = _GALERY_IMG_PATH_ . $image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // MAJ NULL (pas d'image)
        $updateQuery = $pdo->prepare('UPDATE vehicules SET galerie_images = NULL WHERE id = :id');
        $updateQuery->bindParam(':id', $carId, PDO::PARAM_INT);
        $updateQuery->execute();
        // SUPPRESSION REUSSIE
        return true;
    }
    // AUCUNE IMAGE A SUPPRIMER OU SUPPRESSION ECHOUEE
    return false;
}


// FUNCTION FETCH CAR INFORMATIONS BASED ON FILTERS CRITERIAS 
function getFilterCars(PDO $pdo, $marque, $carburant, $minPrice, $maxPrice, $minkilometrage, $maxkilometrage, $minAnnee, $maxAnnee)
{
    // REQUEST SQL TO FETCH CARS
    $sql = 'SELECT * FROM vehicules WHERE 1=1';
    // ADD FILTER CONDITIONS TO THE REQUEST
    if ($marque) {
        $sql .= ' AND marque = :marque';
    }
    if ($carburant) {
        $sql .= ' AND carburant = :carburant';
    }

    if ($minPrice !== '' && $maxPrice !== '') {
        $sql .= ' AND prix BETWEEN :minPrice AND :maxPrice';
    }

    if ($minkilometrage !== '' && $maxkilometrage !== '') {
        $sql .= ' AND kilometrage BETWEEN :minkilometrage AND :maxkilometrage';
    }

    if ($minAnnee !== '' && $maxAnnee !== '') {
        $sql .= ' AND annee_mise_en_circulation BETWEEN :minAnnee AND :maxAnnee';
    }
    // PREPARING THE REQUEST
    $query = $pdo->prepare($sql);
    // LINKING PARAMETERS TO THE REQUEST PLACEHOLDERS
    if ($marque) {
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
    }

    if ($carburant) {
        $query->bindParam(':carburant', $carburant, PDO::PARAM_STR);
    }

    if ($minPrice !== '' && $maxPrice !== '') {
        $query->bindParam(':minPrice', $minPrice, PDO::PARAM_INT);
        $query->bindParam(':maxPrice', $maxPrice, PDO::PARAM_INT);
    }

    if ($minkilometrage !== '' && $maxkilometrage !== '') {
        $query->bindParam(':minkilometrage', $minkilometrage, PDO::PARAM_INT);
        $query->bindParam(':maxkilometrage', $maxkilometrage, PDO::PARAM_INT);
    }

    if ($minAnnee !== '' && $maxAnnee !== '') {
        $query->bindParam(':minAnnee', $minAnnee, PDO::PARAM_INT);
        $query->bindParam(':maxAnnee', $maxAnnee, PDO::PARAM_INT);
    }
    // EXECUTE THE REQUEST
    $query->execute();
    // FETCH THE RESULTS IN AN ASSOCIATIVE ARRAY
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// SORT BY YEAR DESC
function trierAnnoncesParAnneeMiseEnCirculationDesc(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY annee_mise_en_circulation DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// SORT BY YEAR ASC
function trierAnnoncesParAnneeMiseEnCirculationAsc(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY annee_mise_en_circulation ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// SORT BY RECENT ID
function trierAnnoncesParDateRecente(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY id DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// SORT BY OLDER ID
function trierAnnoncesParDateAncienne(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY id ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// SORT BY PRICE ASC
function trierAnnoncesParPrixCroissant(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY prix ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// SORT BY PRICE DESC
function trierAnnoncesParPrixDecroissant(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY prix DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// SORT BY ASC MILEAGE
function trierAnnoncesParKilometrageCroissant(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY kilometrage ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// SORT BY DESC MILEAGE
function trierAnnoncesParKilometrageDecroissant(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY kilometrage DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
