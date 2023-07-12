<?php
require_once('templates/header.php');


$cars = getCars($pdo);
?>


<!-- HEADER START -->
<!-- Fil d'ariane -->
<nav aria-label="breadcrumb" class="mt-5 pt-5">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nos véhicules d'occasions</li>
        </ol>
    </div>
</nav>

<h1>Liste des véhicules</h1>
<p>Vous trouverez ci-dessous la liste des véhicules disponibles à la vente.</p>
<!-- HEADER END -->

<!-- MAIN START -->

<!--Content cards service cars-->
<!-- USED ​​VEHICLES EXAMPLES -->
<div class="d-flex flex-row justify-content-start align-items-center">
    <div class="card-container">

        <?php foreach ($cars as $key => $car) {
            include('templates/car_partial.php');
        } ?>
        <!-- MAIN END -->
        <!-- BUTTON BACK TO TOP -->
        <div class="back-to-top">
            <a href="cars.php">
                <button class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                    </svg>
                </button>
            </a>
        </div>

        <!-- FOOTER START -->
        <?php
        require_once('templates/footer.php');
        // FOOTER END
        //  IMPORT SCRIPTS 
        require_once('lib/scripts.php');
        ?>