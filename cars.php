<?php
require_once('lib/session.php');
require_once('lib/pdo.php');
require_once('templates/header.php');
require_once('lib/car_tools.php');

// Récupérer le critère de tri depuis la demande AJAX
try {
  $tri = isset($_GET['tri']) ? htmlspecialchars($_GET['tri'], ENT_QUOTES, 'UTF-8') : null;
  $marque = isset($_GET['marque']) ? htmlspecialchars($_GET['marque'], ENT_QUOTES, 'UTF-8') : null;
  $carburant = isset($_GET['carburant']) ? htmlspecialchars($_GET['carburant'], ENT_QUOTES, 'UTF-8') : null;
  $minPrice = isset($_GET['minPrice']) ? htmlspecialchars($_GET['minPrice'], ENT_QUOTES, 'UTF-8') : null;
  $maxPrice = isset($_GET['maxPrice']) ? htmlspecialchars($_GET['maxPrice'], ENT_QUOTES, 'UTF-8') : null;
  $minkilometrage = isset($_GET['minkilometrage']) ? htmlspecialchars($_GET['minkilometrage'], ENT_QUOTES, 'UTF-8') : null;
  $maxkilometrage = isset($_GET['maxkilometrage']) ? htmlspecialchars($_GET['maxkilometrage'], ENT_QUOTES, 'UTF-8') : null;
  $minAnnee = isset($_GET['minAnnee']) ? htmlspecialchars($_GET['minAnnee'], ENT_QUOTES, 'UTF-8') : null;
  $maxAnnee = isset($_GET['maxAnnee']) ? htmlspecialchars($_GET['maxAnnee'], ENT_QUOTES, 'UTF-8') : null;
  $CarSliders = [];

  if ($tri === "recentes") {
    $CarSliders = trierAnnoncesParDateRecente($pdo);
  } elseif ($tri === "anciennes") {
    $CarSliders = trierAnnoncesParDateAncienne($pdo);
  } elseif ($tri === "prix-croissant") {
    $CarSliders = trierAnnoncesParPrixCroissant($pdo);
  } elseif ($tri === "prix-decroissant") {
    $CarSliders = trierAnnoncesParPrixDecroissant($pdo);
  } elseif ($tri === "kilometrage-croissant") {
    $CarSliders = trierAnnoncesParKilometrageCroissant($pdo);
  } elseif ($tri === "kilometrage-decroissant") {
    $CarSliders = trierAnnoncesParKilometrageDecroissant($pdo);
  } elseif ($tri === "annee-mise-en-circulation-asc") {
    $CarSliders = trierAnnoncesParAnneeMiseEnCirculationAsc($pdo);
  } elseif ($tri === "annee-mise-en-circulation-desc") {
    $CarSliders = trierAnnoncesParAnneeMiseEnCirculationDesc($pdo);
  } else {
    $CarSliders = getCars($pdo);
  }
  // RECUPERER LES MARQUES ET CARBURANTS DEPUIS LA BDD
  $marqueQuery = $pdo->query('SELECT DISTINCT marque FROM vehicules');
  $marques = $marqueQuery->fetchAll(PDO::FETCH_COLUMN);

  $carburantQuery = $pdo->query('SELECT DISTINCT carburant FROM vehicules');
  $carburants = $carburantQuery->fetchAll(PDO::FETCH_COLUMN);
  $reset = isset($_GET['reset']);

  // REINITIALISER LES FILTRES
  if ($reset) {
    $marque = null;
    $carburant = null;
    $minPrice = '';
    $maxPrice = '';
    $minkilometrage = '';
    $maxkilometrage = '';
    $minAnnee = '';
    $maxAnnee = '';
  }
  // FONCTIONS DE FILTRAGE
  if ($marque || $carburant || ($minPrice !== '' && $maxPrice !== '') || ($minkilometrage !== '' && $maxkilometrage !== '') || ($minAnnee !== '' && $maxAnnee !== '')) {
    $CarSliders = getFilterCars($pdo, $marque, $carburant, $minPrice, $maxPrice, $minkilometrage, $maxkilometrage, $minAnnee, $maxAnnee);
  }
} catch (Exception $e) {
  http_response_code(500);
  echo "Erreur serveur : " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
?>

<!-- FIL D'ARIANE -->
<nav aria-label="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item active" aria-current="page">Nos véhicules d'occasion</li>
    </ol>
  </div>
</nav>

<!-- MAIN START -->
<!-- FILTRES DES VEHICULES -->
<div class="row justify-content-center" id="containerFilter">
  <div class="col-12 col-md-4" id="filterCars">
    <?php include_once('templates/filterCar_form.php'); ?>
  </div>

  <!-- FONCTION SORT BY -->
  <div class="col-md-8">
    <!-- Div pour afficher les résultats triés -->
    <div class="grid-container" id="gridContainer"></div>
  </div>
</div>
<!-- MAIN END -->

<!-- BUTTON BACK TO TOP -->
<div class="back-to-top-container p-4">
  <div class="back-to-top">
    <div class="btn btn-primary">
      <a href="cars.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
        </svg>
      </a>
    </div>
  </div>
</div>
<!-- FOOTER START -->
<script src="assets/JS/tri_cars.js"></script>
<script src="assets/JS/filter_cars.js"></script>

<?php
require_once('templates/footer.php');
// FOOTER END
?>