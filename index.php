<?php

$cars = [
    ['title' => 'Ferrari', 'description' => 'Ferrari V8 à 90°, 3,6 L, 40 soupapes ', 'image' => 'ferrari-2468015_1280.jpg'],
    ['title' => 'Tesla', 'description' => 'Tesla V8 à 90°, 3,6 L, 40 soupapes ', 'image' => 'tesla.webp'],
    ['title' => 'Audi', 'description' => 'Audi V8 à 90°, 3,6 L, 40 soupapes ', 'image' => 'audi.jpg'],
];

require_once('templates/header.php');
require_once('lib/car_tools.php');
?>

<body class="container">
    <!-- HEADER START -->

    <!-- HEADER END -->

    <!-- MAIN START -->
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="assets/images/mecanicien.webp" class="d-block mx-lg-auto img-fluid" alt="Mecanicien" width="500" height="350" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3"><span>Garagiste</span> près de Toulouse pour la réparation, l'entretien et l'achats
                de véhicules</h1>
            <div class="text">
                <div class="headline p-2">Votre <strong>Garage V. Parrot,</strong>
                    dispose d'un atelier depuis 2021. Ainsi, nos mécaniciens et carrossiers-peintres professionnels
                    accompagnent leurs clients dans toutes les réparations liées à l'automobile.
                    <br>
                    <br>
                    Nous pouvons réaliser notamment les prestations suivantes :
                    <br>
                    <br>
                    <ul>
                        <li>Peinture après travaux,</li>
                        <li>Remise en état d'éléments amovibles de la carrosserie,</li>
                        <li>Redressage de bas de caisse,</li>
                        <li>Remplacement de bougies d'allumage,</li>
                        <li>Pose d'attelage sur véhicules de toutes marques,</li>
                        <li>Remplacement d'amortisseurs,</li>
                        <li>Contrôle et remplacement de disques de frein,</li>
                    </ul>
                    <br>
                    Vous avez alors la possibilité de laisser votre véhicule entre de bonnes mains. Nos compétences
                    et savoir-faire sont à la disposition de tous nos clients.
                    <br>
                    <br>
                    Notre entreprise agrée <strong>Toutes marques</strong>
                    vous permettra de retrouver un véhicule réparé et sécurisé pour vous et votre famille.
                    <br>
                    <br>
                    Si vous avez besoin d'un renseignement complémentaire ou bien d'une prise de rendez-vous,
                    n'hésitez pas à prendre contact avec votre garage, situé à Toulouse.
                </div>
            </div>
        </div>
    </div>

    <!--Content service cards and cars-->
    <div class="d-flex flex-row justify-content-start align-items-center">
        <div class="card-container">
            <article>
                <div class="card card-animate-left">
                    <a href="Prestations-reparations-mecaniques.html">
                        <img src="assets/images/Motor.webp" class="card-img-top rounded-3" alt="motor">
                    </a>
                    <div class="card-body">
                        <h2 class="card-title">ENTRETIEN ET MECANIQUE</h2>
                        <p class="card-text">Notre équipe de mécaniciens expérimentés est à votre
                            disposition pour réparer tout type de problème mécanique.
                            Nous proposons une large gamme de services de réparation, quels que soient la
                            marque et le modèle de votre véhicule.</p>
                        <a href="#" class="btn btn-primary">En savoir +</a>
                    </div>
                </div>
            </article>

            <article>
                <div class="card card-animate-center">
                    <a href="Prestations-reparation-carrosserie-peinture.html">
                        <img src="assets/images/carrosserie.jpg" class="card-img-top rounded-3" alt="Carrosserie">
                    </a>
                    <div class="card-body">
                        <h2 class="card-title">CARROSSERIE ET PEINTURE</h2>
                        <p class="card-text">Nous prenons en charge la réparation et le redressement
                            de la carrosserie de votre véhicule, pour lui redonner son aspect d'origine.
                            Vous êtes tout à fait libre de choisir votre réparateur, renseignez-vous auprès
                            de votre assurance.</p>
                        <a href="#" class="btn btn-primary">En savoir +</a>
                    </div>
                </div>
            </article>

            <article>
                <div class="card card-animate-right">
                    <a href="cars.php">
                        <img src="media/hypercar.jpg" class="card-img-top rounded-3" alt="hypercar3">
                    </a>
                    <div class="card-body">
                        <h2 class="card-title">NOS VEHICULES D'OCCASIONS</h2>
                        <p class="card-text">Nous vous proposons des véhicules d'occasions réparés par nos soins et disponible immédiatemment à l'achat, vous avez la possibilité de prendre rendez-vous auprès de notre équipe afin de venir voir celui qui vous interesse directement sur place. </p>
                        <a href="cars.php" class="btn btn-primary">Voir les véhicules</a>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <br>
    <br>

    <!-- USED ​​VEHICLES EXAMPLES -->
    <div class="d-flex flex-row justify-content-start align-items-center">
        <div class="card-container">

            <?php foreach ($cars as $key => $car) {
                include('templates/car_partial.php');
            } ?>

            <!-- MAIN END -->

            <!-- FOOTER START -->
            <?php
            require_once __DIR__ . ('/templates/footer.php');
            // FOOTER END
            //  IMPORT SCRIPTS 
            require_once __DIR__ . ('/lib/scripts.php');
            ?>