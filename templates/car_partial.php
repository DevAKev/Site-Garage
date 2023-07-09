<article>
    <div class="card card-animate-center">
        <a href="car.php?id=<?= $key; ?>">
            <img src="<?= getCarImage($car['image']); ?>" class="card-img-top rounded-3" alt="cars">
        </a>
        <div class="card-body">
            <h5 class="card-title"><?= $car['marque']; ?></h5>
            <p class="card-text"><?= $car['caracteristiques']; ?></p>
            <a href="car.php?id=<?= $car['id']; ?>" class="btn btn-primary">Voir ce véhicule</a>
        </div>
    </div>
</article>