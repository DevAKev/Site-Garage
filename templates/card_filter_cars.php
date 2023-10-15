<div class="col-8" id="containerCards">
    <div class="row justify-content-around">
        <?php foreach ($CarSliders as $key => $CarSlider) { ?>
            <div class="card" id="filterCards">
                <div class="card-header bg-transparent d-flex justify-content-between">
                    <h6 class="card-title"><?= htmlspecialchars($CarSlider['marque'], ENT_QUOTES, 'UTF-8'); ?></h6>
                    <h6><?= htmlspecialchars($CarSlider['modele'], ENT_QUOTES, 'UTF-8'); ?></h6>
                </div>
                <a href="car.php?id=<?= htmlspecialchars($CarSlider['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <img src="<?= htmlspecialchars(getCarImage($CarSlider['image']), ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?= htmlspecialchars($CarSlider['marque'], ENT_QUOTES, 'UTF-8'); ?>">
                </a>
                <div class="card-body">
                    <p class="card-text">
                    <ul class="list-group">
                        <li class="list-group-item"><?= number_format(htmlspecialchars($CarSlider['prix'], ENT_QUOTES, 'UTF-8'), 0, ' ', ' '); ?> €</li>
                        <li class="list-group-item"><?= number_format(htmlspecialchars($CarSlider['kilometrage'], ENT_QUOTES, 'UTF-8'), 0, ' ', ' '); ?> km</li>
                        <li class="list-group-item"><?= htmlspecialchars($CarSlider['carburant'], ENT_QUOTES, 'UTF-8'); ?></li>
                        <li class="list-group-item"><?= htmlspecialchars($CarSlider['annee_mise_en_circulation'], ENT_QUOTES, 'UTF-8'); ?></li>
                    </ul>
                    </p>
                    <a href="./car.php?id=<?= htmlspecialchars($CarSlider['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary m-4">Voir ce véhicule</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>