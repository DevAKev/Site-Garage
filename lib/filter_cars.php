<?php
require_once('lib/pdo.php');
require_once('lib/car_tools.php');

$UsedVehiculeSliders = getImportUsedVehicle($pdo);
?>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- SLIDER USED VEHICLE START CONTENT ONE -->
        <?php
        $chunkedUsedVehicles = array_chunk($UsedVehiculeSliders, 4); // Divise les véhicules en groupes de 3 éléments

        foreach ($chunkedUsedVehicles as $key => $chunk) {
            $active = ($key == 0) ? 'active' : '';
        ?>
            <div class="carousel-item <?= $active ?>" data-bs-interval="4000">
                <div class="row justify-content-around">
                    <!-- CARD START -->
                    <?php foreach ($chunk as $UsedVehiculeSlider) { ?>
                        <div class="card" style="width: 18rem;">
                            <a href="car.php?id=<?= $UsedVehiculeSlider["id"] ?>"><img src="<?= $UsedVehiculeSlider['image']; ?>" class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <p class="card-text">
                                <ul class="list-group">
                                    <li class="list-group-item"><?= $UsedVehiculeSlider['marque']; ?></li>
                                    <li class="list-group-item"><?= $UsedVehiculeSlider['modele']; ?></li>
                                    <li class="list-group-item"><?= $UsedVehiculeSlider['prix']; ?> €</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- CARD END -->
                </div>
            </div>
        <?php } ?>
        <!-- SLIDER END CONTENT ONE -->
    </div>
</div>