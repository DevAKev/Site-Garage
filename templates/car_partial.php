<div class="card card-animate-center">
    <a href="car.php?id=<?= $car['id']; ?>">
        <img src="<?= getCarImage($car['image']); ?>" class="card-img-top rounded-3" alt="<?= $car['marque']; ?>">
    </a>
    <div class="card-body">
        <h5 class="card-title"><?= $car['marque'] . ' ' . $car['modele']; ?></h5>
        <p class="card-text">Prix: <?= number_format($car['prix'], 0, ' ', ' '); ?> €</p>
        <a href="car.php?id=<?= $car['id']; ?>" class="btn btn-primary">Voir ce véhicule</a>
    </div>
</div>