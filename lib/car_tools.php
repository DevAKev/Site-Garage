<?php
// FONCTION RECUPERATION DES VEHICULES EN FONTION DE LEUR ID
function getCarById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM vehicules WHERE id=:id');
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}

// AFFICHE IMAGE BDD OU IMAGE PAR DEFAUT SI PAS D'IMAGE
function getCarImage(string $image)
{
    if ($image === null || $image === '') {
        return 'assets/images/default_car_image.jpg';
    } else {
        return 'uploads/cars/' . $image;
    }
}

// RECUPERE LES ANNONCES EN LES AFFICHANT ALEATOIREMENT SUR LA PAGE D'ACCUEIL
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

// RECUPERE LES DONNEES DU FORMULAIRE D'AJOUT DE VEHICULE
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

// FONCTION MAJ DES ANNONCES
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

// FONCTION DE SUPPRESSION D'ANNONCE
function deleteCar(PDO $pdo, int $id)
{
    $query = $pdo->prepare('DELETE FROM vehicules WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    return $query->execute();
}

// RECUPERE LES HORAIRES DE LA BASE DE DONNEES
function getSchedules($pdo)
{
    $query = $pdo->prepare('SELECT * FROM schedules');
    $query->execute();
    $heure_ouverture = array();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $jour_semaine = $row['jour_semaine'];
        unset($row['jour_semaine']);
        if (!isset($heure_ouverture[$jour_semaine])) {
            $heure_ouverture[$jour_semaine] = array();
        }
        $heure_ouverture[$jour_semaine][] = $row;
    }
    return $heure_ouverture;
}

// function deleteSchedule(PDO $pdo, int $id)
// {
//     $query = $pdo->prepare('DELETE FROM schedules WHERE id = :id');
//     $query->bindParam(':id', $id, PDO::PARAM_INT);
//     return $query->execute();
// }

function getFilterCars(PDO $pdo, $marque, $carburant, $minPrice, $maxPrice, $minkilometrage, $maxkilometrage, $minAnnee, $maxAnnee)
{
    $sql = 'SELECT * FROM vehicules WHERE 1=1';

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

    $query = $pdo->prepare($sql);

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

    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getImportCar(PDO $pdo, int $id = null, int $limit = null)
{
    $sql = 'SELECT *, COALESCE(image, :defaultImage) AS image FROM vehicules';

    if ($id) {
        $sql .= ' WHERE id = :id';
    } else {
        $sql .= ' ORDER BY id DESC';
    }

    if ($limit) {
        $sql .= ' LIMIT :limit';
    }

    $query = $pdo->prepare($sql);

    $defaultImage = './assets/images/default_car_image.jpg';
    $query->bindParam(':defaultImage', $defaultImage, PDO::PARAM_STR);

    if ($id) {
        $query->bindParam(':id', $id, PDO::PARAM_INT);
    }

    if ($limit) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();

    if ($id) {
        return $query->fetch(PDO::FETCH_ASSOC);
    } else {
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
//Trier les annonces par année de mise en circulation
function trierAnnoncesParAnneeMiseEnCirculationDesc(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY annee_mise_en_circulation DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function trierAnnoncesParAnneeMiseEnCirculationAsc(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY annee_mise_en_circulation ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Trier les annonces par ID plus récent
function trierAnnoncesParDateRecente(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY id DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Trier les annonces par ID plus ancien
function trierAnnoncesParDateAncienne(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY id ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Trier les annonces par prix croissant
function trierAnnoncesParPrixCroissant(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY prix ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Trier les annonces par prix décroissant
function trierAnnoncesParPrixDecroissant(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY prix DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Trier les annonces par kilométrage croissant
function trierAnnoncesParKilometrageCroissant(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY kilometrage ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Trier les annonces par kilométrage décroissant
function trierAnnoncesParKilometrageDecroissant(PDO $pdo)
{
    $sql = 'SELECT * FROM vehicules ORDER BY kilometrage DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
