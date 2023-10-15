<div class="card card-animate-center">
    <a href="car.php?id=<?= htmlspecialchars($car['id'], ENT_QUOTES, 'UTF-8'); ?>">
        <img src="<?= htmlspecialchars(getCarImage($car['image']), ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top rounded-3" alt="<?= htmlspecialchars($car['marque'], ENT_QUOTES, 'UTF-8'); ?>">
    </a>
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($car['marque'] . ' ' . $car['modele'], ENT_QUOTES, 'UTF-8'); ?></h5>
        <p class="card-text">Prix: <?= number_format(htmlspecialchars($car['prix'], ENT_QUOTES, 'UTF-8'), 0, ' ', ' '); ?> €</p>
        <a href="car.php?id=<?= htmlspecialchars($car['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">Voir ce véhicule</a>
    </div>
</div>