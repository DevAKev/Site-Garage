<!-- RECIPE.php -->
<!-- Equivalent à un fichier de configuration, on peut y mettre des variables, des constantes, des fonctions, des classes, etc. -->
<?php

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

// AFFICHE IMAGE BDD OU IMAGE PAR DEFAUT SI PAS D'IMAGE
function getCarImage(string $image)
{
    if ($image === null || $image === '') {
        return 'assets/images/default_car_image.jpg';
    } else {
        return _CARS_IMG_PATH_ . $image;
    }
}

// RECUPERE LES ELEMENTS DE LA TABLE VEHICULES
function getCarById(PDO $pdo, int $id)
{
    $query = $pdo->prepare("SELECT * FROM vehicules WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

// RETOUR A LA LIGNE TABLEAUX CARACTS ET EQUIPEMENTS
function linesToArray(string $string)
{
    return explode(PHP_EOL, $string);
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

// RECUPERE LES DONNEES DU FORMULAIRE
//***************************************** A CORRIGER **********************************
function saveCar(PDO $pdo, string $marque, string $modele, string $prix, string $image, string $annee_mise_en_circulation, string $kilometrage, string $galerie_images, string $caracteristiques, string $equipements_options, string $carburant)
{
    $sql = "INSERT INTO `vehicules` (`id`, `marque`, `modele`, `prix`, `image`, `annee_mise_en_circulation`, `kilometrage`, `galerie_images`, `caracteristiques`, `equipements_options`, `carburant`) VALUES (NULL, :marque, :modele, :prix:, NULL, annee_mise_en_circulation, :kilometrage, NULL, :caracteristiques, :equipements_options, :carburant);";
    $query = $pdo->prepare($sql);
    $query->bindParam(':marque', $marque, PDO::PARAM_STR);
    $query->bindParam(':modele', $modele, PDO::PARAM_STR);
    $query->bindParam(':prix', $prix, PDO::PARAM_STR);
    $query->bindParam(':image', $image, PDO::PARAM_STR);
    $query->bindParam(':annee_mise_en_circulation', $annee_mise_en_circulation, PDO::PARAM_STR);
    $query->bindParam(':kilometrage', $kilometrage, PDO::PARAM_STR);
    $query->bindParam(':galerie_images', $galerie_images, PDO::PARAM_STR);
    $query->bindParam(':caracteristiques', $caracteristiques, PDO::PARAM_STR);
    $query->bindParam(':equipements_options', $equipements_options, PDO::PARAM_STR);
    $query->bindParam(':carburant', $carburant, PDO::PARAM_INT);
    return $query->execute();
}
