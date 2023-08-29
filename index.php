<?php
require_once __DIR__ . '/lib/session.php';
require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . ('/templates/header.php');
require_once __DIR__ . ('/lib/reviews_tools.php');
require_once('lib/service_tools.php');
require_once('lib/car_tools.php');

// CONSTANTE NOMBRE DE VEHICULES A AFFICHER SUR LA PAGE D'ACCUEIL(PARAMETRE DANS LE FICHIER CONFIG.PHP)
$cars = getCars($pdo, _HOME_CARS_LIMIT_);
$reviews = getPublishImportReviews($pdo, _HOME_REVIEWS_LIMIT_);
$services = getServices($pdo);
?>

<!-- MAIN START -->
<?php include('templates/presentation.php') ?>
<div id="accueil-image">
    <!-- AFFICHAGE DES AVIS UTILISATEURS SUR LA PAGE D'ACCUEIL -->
    <?php include('templates/reviews_partial.php') ?>
</div>
<br>
<br>
<!--SERVICES & CARS CARDS-->
<?php include('templates/service_partial.php') ?>
<!-- USED ​​VEHICLES EXAMPLES -->
<div class="d-flex flex-wrap justify-content-start align-items-center">
    <div class="card-container">
        <?php foreach ($cars as $key => $car) {
            include('templates/car_partial.php');
        } ?>
        <a href="cars.php" class="btn btn-primary m-4 mb-4">Voir plus</a>
    </div>
</div>

<!-- MAIN END -->
<!-- BUTTON BACK TO TOP -->
<div class="back-to-top-container">
    <div class="back-to-top">
        <div class="btn btn-primary p-2">
            <a href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- FOOTER START -->
<script src="assets/JS/script_scroll_window.js"></script>

<?php
require_once __DIR__ . ('/templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS
?>