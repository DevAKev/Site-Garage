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
        // KILLOMETRAGE DECROISSANT
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
// }
