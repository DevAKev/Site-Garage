<?php
require_once('lib/pdo.php');
require_once('lib/car_tools.php');

$sql = "SELECT * FROM vehicules WHERE 1=1";

if (!empty($_GET['marque'])) {
    $sql .= " AND marque = :marque";
}

if (!empty($_GET['carburant'])) {
    $sql .= " AND carburant = :carburant";
}

if (!empty($_GET['minPrice'])) {
    $sql .= " AND prix >= :minPrice";
}

if (!empty($_GET['maxPrice'])) {
    $sql .= " AND prix <= :maxPrice";
}

if (!empty($_GET['minkilometrage'])) {
    $sql .= " AND kilometrage >= :minkilometrage";
}

if (!empty($_GET['maxkilometrage'])) {
    $sql .= " AND kilometrage <= :maxkilometrage";
}

if (!empty($_GET['minAnnee'])) {
    $sql .= " AND annee_mise_en_circulation >= :minAnnee";
}

if (!empty($_GET['maxAnnee'])) {
    $sql .= " AND annee_mise_en_circulation <= :maxAnnee";
}


$sortBy = $_GET['sortBy'];
switch ($sortBy) {
    case 'recentes':
        $sql .= " ORDER BY id DESC";
        break;
    case 'anciennes':
        $sql .= " ORDER BY id ASC";
        break;
    case 'prix-croissant':
        $sql .= " ORDER BY prix ASC";
        break;
    case 'prix-decroissant':
        $sql .= " ORDER BY prix DESC";
        break;
    case 'kilometrage-croissant':
        $sql .= " ORDER BY kilometrage ASC";
        break;
    case 'kilometrage-decroissant':
        $sql .= " ORDER BY kilometrage DESC";
        break;
    case 'annee-mise-en-circulation-asc':
        $sql .= " ORDER BY annee_mise_en_circulation ASC";
        break;
    case 'annee-mise-en-circulation-desc':
        $sql .= " ORDER BY annee_mise_en_circulation DESC";
        break;
    default:
        $sql .= " ORDER BY id DESC";
        break;
}

$stmt = $pdo->prepare($sql);


if (!empty($_GET['marque'])) {
    $stmt->bindValue(':marque', $_GET['marque'], PDO::PARAM_STR);
}

if (!empty($_GET['carburant'])) {
    $stmt->bindValue(':carburant', $_GET['carburant'], PDO::PARAM_STR);
}

if (!empty($_GET['minPrice'])) {
    $stmt->bindValue(':minPrice', $_GET['minPrice'], PDO::PARAM_INT);
}

if (!empty($_GET['maxPrice'])) {
    $stmt->bindValue(':maxPrice', $_GET['maxPrice'], PDO::PARAM_INT);
}

if (!empty($_GET['minkilometrage'])) {
    $stmt->bindValue(':minkilometrage', $_GET['minkilometrage'], PDO::PARAM_INT);
}

if (!empty($_GET['maxkilometrage'])) {
    $stmt->bindValue(':maxkilometrage', $_GET['maxkilometrage'], PDO::PARAM_INT);
}

if (!empty($_GET['minAnnee'])) {
    $stmt->bindValue(':minAnnee', $_GET['minAnnee'], PDO::PARAM_INT);
}

if (!empty($_GET['maxAnnee'])) {
    $stmt->bindValue(':maxAnnee', $_GET['maxAnnee'], PDO::PARAM_INT);
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = null;

header('Content-Type: application/json');
echo json_encode($result);
