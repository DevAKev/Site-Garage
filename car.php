<?php
require_once("lib/config.php");
require_once("lib/session.php");
require_once('templates/header.php');

// REQUETE VEHICULES SQL BDD
$id = (int)htmlspecialchars($_GET['id'] ?? 0, ENT_QUOTES, 'UTF-8');

$vehicule = getCarById($pdo, $id);

if ($vehicule) {
    // RETOUR A LA LIGNE TABLEAUX CARACTS ET EQUIPEMENTS
    $caracts = linesToArray(htmlspecialchars($vehicule['caracteristiques'] ?? '', ENT_QUOTES, 'UTF-8'));
    $equipements = linesToArray(htmlspecialchars($vehicule['equipements_options'] ?? '', ENT_QUOTES, 'UTF-8'));
?>

    <!-- MAIN START -->

    <!-- USED ​​VEHICLES EXAMPLES -->
    <div class="container my-5">
        <div class="row pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 mb-4"><?= htmlspecialchars($vehicule['marque'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h1>
                <h2 class="fw-bold lh-1"><?= htmlspecialchars($vehicule['modele'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2>
                <h3><?= number_format($vehicule['prix'], 0, ' ', ' '); ?> €</h3>
                <div class="d-flex justify-content-around">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item fw-bold p-2">Marque</li>
                        <li class="list-group-item fw-bold p-2">Modèle</li>
                        <li class="list-group-item fw-bold p-2">Kilométrage</li>
                        <li class="list-group-item fw-bold p-2">Année de mise en circulation</li>
                        <li class="list-group-item fw-bold p-2">Carburant</li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-2"><?= htmlspecialchars($vehicule['marque'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
                        <li class="list-group-item p-2"><?= htmlspecialchars($vehicule['modele'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
                        <li class="list-group-item p-2"><?= number_format($vehicule['kilometrage'], 0, ' ', ' '); ?> km</li>
                        <li class="list-group-item p-2"><?= htmlspecialchars($vehicule['annee_mise_en_circulation'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
                        <li class="list-group-item p-2"><?= htmlspecialchars($vehicule['carburant'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
                    </ul>
                </div>
                <br>
                <h4 class="fw-bold">Caracteristiques du véhicule : </h4>
                <ul class="list-group">
                    <?php foreach ($caracts as $key => $caract) { ?>
                        <li class="list-group-item"><?= htmlspecialchars($caract, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php } ?>
                    <br>
                    <h4 class="fw-bold">Liste des options : </h4>
                    <?php foreach ($equipements as $key => $equipement) { ?>
                        <li class="list-group-item"><?= htmlspecialchars($equipement, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php } ?>
                </ul>
                <br>

                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                    <a href="Contacter-le-garage-V-Parrot.php?vehicule_id=<?= htmlspecialchars($vehicule['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&marque=<?= htmlspecialchars($vehicule['marque'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&modele=<?= htmlspecialchars($vehicule['modele'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&prix=<?= htmlspecialchars($vehicule['prix'] ?? '', ENT_QUOTES, 'UTF-8'); ?>&objet=Demande%20d'information%20pour%20<?= htmlspecialchars($vehicule['marque'] ?? '', ENT_QUOTES, 'UTF-8'); ?>%20<?= htmlspecialchars($vehicule['modele'] ?? '', ENT_QUOTES, 'UTF-8'); ?>%20(ID:<?= htmlspecialchars($vehicule['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>)" class="btn btn-primary">Contactez-nous</a>

                    <!-- VERIFIER SI UNE SESSION EST ACTIVE ET SI L'UTILISATEUR A LE ROLE D'ADMINISTRATEUR OU D'EMPLOYE -->
                    <?php if (isset($_SESSION['user']) && (($_SESSION['user']['role'] == 'administrateur') || ($_SESSION['user']['role'] == 'employe'))) {

                        // AFFICHER LE BOUTON "MODIFIER L'ANNONCE" UNIQUEMENT POUR L'ADMINISTRATEURS ET LES EMPLOYES
                        echo '<a href="edit_car.php?id=' . htmlspecialchars($vehicule['id'] ?? '', ENT_QUOTES, 'UTF-8') . '" class="btn btn-warning">Modifier l\'annonce</a>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 overflow-hidden shadow-lg">
                <a data-fancybox="gallery" href="<?= htmlspecialchars(getCarImage($vehicule['image'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
                    <img src="<?= htmlspecialchars(getCarImage($vehicule['image'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" class="rounded-lg-3" alt="<?= htmlspecialchars($vehicule['marque'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" width="100%">
                </a>

                <!-- AFFICHER LES PHOTOS DE LA GALERIE -->
                <?php
                $galerie_images = explode(',', $vehicule['galerie_images'] ?? '');
                foreach ($galerie_images as $image) {
                    echo '<a data-fancybox="gallery" href="' . htmlspecialchars(_GALERY_IMG_PATH_ . $image, ENT_QUOTES, 'UTF-8') . '"><img class="rounded-lg-3" src="' . htmlspecialchars(_GALERY_IMG_PATH_ . $image, ENT_QUOTES, 'UTF-8') . '" alt="" width="100%"></a>';
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
<script>
    // INITIALISER LIGHTBOX (Affichage des images en grand)
    $(document).ready(function() {
        $('[data-fancybox="gallery"]').fancybox({
            // OPTIONS BUTTON DE LA LIGHTBOX
            buttons: ['slideShow', 'fullScreen', 'thumbs', 'close'],
            loop: true, // ACTIVER LA LECTURE EN BOUCLE
            arrows: true // ACTIVER LES FLECHES DE NAVIGATION
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<?php
require_once('templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
?>