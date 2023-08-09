<?php
require_once('lib/session.php');
require_once('lib/pdo.php');
require_once('templates/header.php');
require_once('lib/car_tools.php');

$cars = getCars($pdo);
$CarSliders = getImportCar($pdo);
// RECUPERER LES MARQUES ET CARBURANTS DEPUIS LA BDD
$marqueQuery = $pdo->query('SELECT DISTINCT marque FROM vehicules');
$marques = $marqueQuery->fetchAll(PDO::FETCH_COLUMN);

$carburantQuery = $pdo->query('SELECT DISTINCT carburant FROM vehicules');
$carburants = $carburantQuery->fetchAll(PDO::FETCH_COLUMN);

$marque = $_GET['marque'] ?? null;
$carburant = $_GET['carburant'] ?? null;
$minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : '';
$maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : '';
$minkilometrage = isset($_GET['minkilometrage']) ? $_GET['minkilometrage'] : '';
$maxkilometrage = isset($_GET['maxkilometrage']) ? $_GET['maxkilometrage'] : '';
$minAnnee = isset($_GET['minAnnee']) ? $_GET['minAnnee'] : '';
$maxAnnee = isset($_GET['maxAnnee']) ? $_GET['maxAnnee'] : '';
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
?>

<!-- FIL D'ARIANE -->
<nav aria-label="breadcrumb" class="mt-5 pt-5">
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item active" aria-current="page">Nos véhicules d'occasions</li>
    </ol>
  </div>
</nav>

<!-- MAIN START -->
<!-- FILTRES DES VEHICULES -->
<div class="row justify-content-center">
  <div class="col-12 col-md-8 p-4">
    <form action="" method="GET" class="form-control p-4">
      <select name="marque" class="form-select mb-3">
        <option value="" selected>Marques</option>
        <?php foreach ($marques as $marqueOption) { ?>
          <option value="<?= $marqueOption ?>" <?= $marque === $marqueOption ? 'selected' : '' ?>><?= $marqueOption ?></option>
        <?php } ?>
      </select>
      <select name="carburant" id="fuel-type" class="form-select mb-3">
        <option value="" selected>Carburant</option>
        <?php foreach ($carburants as $carburantOption) { ?>
          <option value="<?= $carburantOption ?>" <?= $carburant === $carburantOption ? 'selected' : '' ?>><?= $carburantOption ?></option>
        <?php } ?>
      </select>
      <label for="price">Prix :</label>
      <div id="price-slider" class="mb-3"></div>
      <input type="hidden" id="minPrice" name="minPrice" value="<?= $minPrice ?>">
      <input type="hidden" id="maxPrice" name="maxPrice" value="<?= $maxPrice ?>">
      <div id="price-values"></div>

      <label for="kilometrage">Kilométrage :</label>
      <div id="kilometrage-slider" class="mb-3"></div>
      <input type="hidden" id="minkilometrage" name="minkilometrage" value="<?= $minkilometrage ?>">
      <input type="hidden" id="maxkilometrage" name="maxkilometrage" value="<?= $maxkilometrage ?>">
      <div id="kilometrage-values"></div>

      <label for="annee">Années :</label>
      <div id="annee-slider" class="mb-3"></div>
      <input type="hidden" id="minAnnee" name="minAnnee" value="<?= $minAnnee ?>">
      <input type="hidden" id="maxAnnee" name="maxAnnee" value="<?= $maxAnnee ?>">
      <div id="annee-values"></div>

      <button type="submit" class="btn btn-warning m-2" name="reset" value="true">Réinitialiser</button>
      <button type="submit" class="btn btn-primary m-2">Filtrer</button>
    </form>
  </div>

  <!-- AFFICHAGE DES VEHICULES -->
  <h1>Liste des véhicules</h1>
  <?php
  include_once('templates/card_filter_cars.php');
  ?>
</div>
<!-- MAIN END -->

<!-- BUTTON BACK TO TOP -->
<div class="back-to-top">
  <div class="btn btn-primary">
    <a href="cars.php">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
      </svg>
    </a>
  </div>
</div>
<!-- FOOTER START -->

<?php
require_once('templates/footer.php');
// FOOTER END
?>