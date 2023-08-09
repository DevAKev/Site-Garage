<div class="col-8 p-3">
    <div class="row justify-content-around">
        <?php foreach ($CarSliders as $key => $CarSlider) { ?>
            <div class="card mb-2" style="width: 16rem">
                <div class="card-header bg-transparent d-flex justify-content-between">
                    <h6 class="card-title"><?= $CarSlider['marque']; ?></h6>
                    <h6><?= $CarSlider['modele']; ?></h6>
                </div>
                <a href="car.php?id=<?= $CarSlider['id']; ?>">
                    <img src="<?= getCarImage($CarSlider['image']); ?>" class="card-img-top" alt="<?= $CarSlider['marque']; ?>">
                </a>
                <div class="card-body">
                    <p class="card-text">
                    <ul class="list-group">
                        <li class="list-group-item"><?= $CarSlider['prix']; ?> €</li>
                        <li class="list-group-item"><?= $CarSlider['kilometrage']; ?> km</li>
                        <li class="list-group-item"><?= $CarSlider['carburant']; ?></li>
                        <li class="list-group-item"><?= $CarSlider['annee_mise_en_circulation']; ?></li>
                    </ul>
                    </p>
                    <a href="./car.php?id=<?= $CarSlider["id"] ?>" class="btn btn-primary m-4">Voir ce véhicule</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>