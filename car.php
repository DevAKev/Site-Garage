<?php
require_once('lib/car_tools.php');
require_once('templates/header.php');

// REQUETE VEHICULES SQL BDD

$id = (int)$_GET['id'];

$vehicule = getCarById($pdo, $id);

if ($vehicule) {
    // RETOUR A LA LIGNE TABLEAUX CARACTS ET EQUIPEMENTS
    $caracts = linesToArray($vehicule['caracteristiques']);
    $equipements = linesToArray($vehicule['equipements_options']);
?>

    <!-- MAIN START -->
    <!--Content cards service cars-->
    <!-- USED ​​VEHICLES EXAMPLES -->
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1"><?= $vehicule['marque']; ?></h1>
                <h2 class="display-4 fw-bold lh-1"><?= $vehicule['modele']; ?></h2>
                <h3 class="display-4 lh-1"><?= number_format($vehicule['prix'], 0, ' ', ' '); ?> €</h3>
                <div class="d-flex justify-content-around">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Marque</li>
                        <li class="list-group-item">Modele</li>
                        <li class="list-group-item">Kilométrage</li>
                        <li class="list-group-item">Année de mise en circulation</li>
                        <li class="list-group-item">Carburant</li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?= $vehicule['marque']; ?></li>
                        <li class="list-group-item"><?= $vehicule['modele']; ?></li>
                        <li class="list-group-item"><?= number_format($vehicule['kilometrage'], 0, ' ', ' '); ?> km</li>
                        <li class="list-group-item"><?= $vehicule['annee_mise_en_circulation']; ?></li>
                        <li class="list-group-item"><?= $vehicule['carburant']; ?></li>
                    </ul>
                </div>
                <br>
                <h4>Caracteristiques du véhicule : </h4>
                <ul class="list-group">
                    <?php foreach ($caracts as $key => $caract) { ?>
                        <li class="list-group-item"><?= $caract; ?></li>
                    <?php } ?>
                    <br>
                    <h4>Liste des options : </h4>
                    <?php foreach ($equipements as $key => $equipement) { ?>
                        <li class="list-group-item"><?= $equipement; ?></li>
                    <?php } ?>
                </ul>
                <br>

                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                    <a href="Contacter-le-garage-V-Parrot.php" class="btn btn-primary">Contactez-nous</a>

                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img src="<?= getCarImage($vehicule['image']); ?>" class="rounded-lg-3" alt="<?= $vehicule['marque']; ?>" width="400">

                <!-- AFFICHER LES PHOTOS DE LA GALERIE -->
                <?php
                $galerie_images = explode(',', $vehicule['galerie_images']);
                foreach ($galerie_images as $image) {
                    echo '<img class="rounded-lg-3" src="' . _CARS_IMG_PATH_ . $image . '" alt="" width="450">';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- MAIN END -->
<?php } else { ?>
    <div class="row text-center">
        <img src="assets/images/default_car_image.jpg" alt="Error" width="100%">
        <h1>Annonce introuvable !</h1>
    </div>

<?php } ?>

<!-- FOOTER START -->
<?php
require_once('templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
require_once('lib/scripts.php');
?>