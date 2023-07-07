<?php
require_once('lib/car_tools.php');
require_once('templates/header.php');
?>


<!-- HEADER START -->

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

        <!-- FOOTER START -->
        <?php
        require_once('templates/footer.php');
        // FOOTER END
        //  IMPORT SCRIPTS 
        require_once('lib/scripts.php');
        ?>