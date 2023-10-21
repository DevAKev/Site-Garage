<?php
require_once('lib/pdo.php');
require_once('lib/car_tools.php');

$sortBy = $_GET['sortBy'];
switch ($sortBy) {
    case 'recentes':
        //  ANNONCES RECENTES
        $sql = "SELECT * FROM vehicules ORDER BY id DESC ";
        break;
    case 'anciennes':
        // ANNONCES ANCIENNES
        $sql = "SELECT * FROM vehicules ORDER BY id ASC;";
        break;
    case 'prix-croissant':
        // PRIX CROISSANT
        $sql = "SELECT * FROM vehicules ORDER BY prix ASC;";
        break;
    case 'prix-decroissant':
        // PRIX DECROISSANT
        $sql = "SELECT * FROM vehicules ORDER BY prix DESC;";
        break;
    case 'kilometrage-croissant':
        // KILOMETRAGE CROISSANT
        $sql = "SELECT * FROM vehicules ORDER BY kilometrage ASC;";
        break;
    case 'kilometrage-decroissant':
        // KILOMETRAGE DECROISSANT
        $sql = "SELECT * FROM vehicules ORDER BY kilometrage DESC;";
        break;
    case 'annee-mise-en-circulation-asc':
        // ANNEE DE MISE EN CIRCULATION CROISSANTE
        $sql = "SELECT * FROM vehicules ORDER BY annee_mise_en_circulation ASC;";
        break;
    case 'annee-mise-en-circulation-desc':
        // ANNEE DE MISE EN CIRCULATION DECROISSANTE
        $sql = "SELECT * FROM vehicules ORDER BY annee_mise_en_circulation DESC;";
        break;
        // PAR DEFAULT
    default:
        $sql = "SELECT * FROM vehicules ORDER BY id DESC;";
        break;
}

$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = null;

header('Content-Type: application/json');
echo json_encode($result);

/* Ce code PHP récupère la valeur de la variable $_GET['sortBy'] qui est passée dans l'URL 
de la requête. En fonction de la valeur de cette variable, une requête SQL est construite 
pour trier les données de la table vehicules en fonction du critère de tri sélectionné.
La requête SQL est préparée et exécutée à l'aide de la classe PDO, qui est une interface 
pour accéder à une base de données dans PHP. Les résultats de la requête sont récupérés 
sous forme d'un tableau associatif à l'aide de la méthode fetchAll().

Enfin, les résultats de la requête sont encodés en JSON à l'aide de la fonction json_encode() 
et renvoyés au client avec le type de contenu application/json à l'aide de la fonction header().

Ce code est utilisé pour fournir une API qui permet de récupérer les données de la table vehicules
triées selon différents critères de tri, en utilisant des requêtes AJAX côté client.*/
