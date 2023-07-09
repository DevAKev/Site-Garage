<!-- RECIPE.php -->
<!-- Equivalent à un fichier de configuration, on peut y mettre des variables, des constantes, des fonctions, des classes, etc. -->
<?php
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
