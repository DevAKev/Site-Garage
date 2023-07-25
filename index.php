<?php
require_once __DIR__ . ('/templates/header.php');



// CONSTANTE NOMBRE DE VEHICULES A AFFICHER SUR LA PAGE D'ACCUEIL(PARAMETRE DANS LE FICHIER CONFIG.PHP)
$cars = getCars($pdo, _HOME_CARS_LIMIT_);
?>
<div id="accueil-image" class="container">
</div>

<body class="container">

    <!-- MAIN START -->
    <?php require_once('templates/main_services.php') ?>

    <!--SERVICES & CARS CARDS-->
    <?php require_once('templates/main_cards.php') ?>

    <!-- USED ​​VEHICLES EXAMPLES -->
    <div class="d-flex flex-wrap justify-content-start align-items-center">
        <div class="card-container">

            <?php foreach ($cars as $key => $car) {
                include('templates/car_partial.php');
            } ?>
            <!-- MAIN END -->
            <!-- BUTTON BACK TO TOP -->
            <div class="back-to-top">
                <a href="index.php">
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                        </svg>
                    </button>
                </a>
            </div>
            <!-- FOOTER START -->
            <?php
            require_once __DIR__ . ('/templates/footer.php');
            // FOOTER END
            //  IMPORT SCRIPTS 
            require_once __DIR__ . ('/lib/scripts.php');
            ?>