<article>
    <div class="card card-animate-center">
        <a href="#">
            <img src="<?= _CARS_IMG_PATH_ . $car['image']; ?>" class="card-img-top rounded-3" alt="cars">
        </a>
        <div class="card-body">
            <h5 class="card-title"><?= $car['title']; ?></h5>
            <p class="card-text"><?= $car['description']; ?></p>
            <a href="car.php?id=<?= $key; ?>" class="btn btn-primary">Voir ce véhicule</a>
        </div>
    </div>
</article>