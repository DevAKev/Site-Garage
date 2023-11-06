<h1>Modifier l'annonce</h1>
<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php } ?>
<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
<?php } ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="marque" class="form-label">Marque : *</label>
        <input type="text" name="marque" id="marque" class="form-control" value="<?= htmlspecialchars($car['marque'], ENT_QUOTES, 'UTF-8') ?>">
    </div>
    <div class="mb-3">
        <label for="modele" class="form-label">Modèle : *</label>
        <input type="text" name="modele" id="modele" class="form-control" value="<?= htmlspecialchars($car['modele'], ENT_QUOTES, 'UTF-8') ?>">
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix : *</label>
        <input type="number" name="prix" id="prix" class="form-control" value="<?= intval($car['prix']) ?>">
    </div>
    <div class="mb-3">
        <label for="annee_mise_en_circulation" class="form-label">Année de mise en circulation : *</label>
        <input type="number" name="annee_mise_en_circulation" id="annee_mise_en_circulation" class="form-control" value="<?= intval($car['annee_mise_en_circulation']) ?>">
    </div>
    <div class="mb-3">
        <label for="kilometrage" class="form-label">Kilométrage : *</label>
        <input type="number" name="kilometrage" id="kilometrage" class="form-control" value="<?= intval($car['kilometrage']) ?>">
    </div>
    <div class="mb-3">
        <label for="caracteristiques" class="form-label">Caractéristiques : *</label>
        <textarea name="caracteristiques" id="caracteristiques" cols="30" rows="5" class="form-control"><?= htmlspecialchars($car['caracteristiques'], ENT_QUOTES, 'UTF-8') ?></textarea>
        <span id="caracteristiques-counter">0/500</span>
    </div>
    <div class="mb-3">
        <label for="equipements_options" class="form-label">Equipements et options : *</label>
        <textarea name="equipements_options" id="equipements_options" cols="10" rows="5" class="form-control"><?= htmlspecialchars($car['equipements_options'], ENT_QUOTES, 'UTF-8') ?></textarea>
        <span id="equipements_optionsCounter">0/500</span>
    </div>
    <div class="mb-3">
        <label for="carburant" class="form-label">Carburant : *</label>
        <select name="carburant" id="carburant" class="form-select">
            <option value="essence" <?= $car['carburant'] === 'essence' ? 'selected' : '' ?>>Essence</option>
            <option value="diesel" <?= $car['carburant'] === 'diesel' ? 'selected' : '' ?>>Diesel</option>
            <option value="electrique" <?= $car['carburant'] === 'electrique' ? 'selected' : '' ?>>Electrique</option>
            <option value="hybride" <?= $car['carburant'] === 'hybride' ? 'selected' : '' ?>>Hybride</option>
        </select>
    </div>
    <div class="mb-3 position-relative">
        <label for="image" class="form-label">Image principale : *</label>
        <input type="file" name="image" id="image" class="form-control">
        <?php if (!empty($car['image'])) { ?>
            <div class="position-relative d-flex justify-content-center align-items-center">
                <img src="<?= htmlspecialchars(getCarImage($car['image']), ENT_QUOTES, 'UTF-8'); ?>" class="rounded-lg-3" alt="<?= htmlspecialchars($car['marque'], ENT_QUOTES, 'UTF-8'); ?>" width="40%">

                <a href="delete_image.php?id=<?= htmlspecialchars($car['image'], ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?')" class="position-absolute top-50 start-50 translate-middle" style="font-size: 10vw;">
                    <i class="bi bi-trash text-danger"></i>
                </a>
            </div>
        <?php } else { ?>
            <!-- Si pas d'image, affiche l'image par défaut -->
            <div class="position-relative d-flex justify-content-center align-items-center">
                <img src="assets/images/default_car_image.jpg" class="rounded-lg-3" alt="Image par défaut" width="40%">
                <a href="#" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?')" class="position-absolute top-50 start-50 translate-middle" style="font-size: 10vw;">
                    <i class="bi bi-trash text-danger"></i>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="mb-3 position-relative">
        <label for="galerie_images" class="form-label">Galerie d'images : *</label>
        <input type="file" name="galerie_images[]" id="galerie_images" class="form-control" multiple>
        <?php
        $galerie_images = explode(',', $car['galerie_images']);
        foreach ($galerie_images as $image) {
            if (!empty($image)) {
        ?>
                <div class="position-relative d-flex justify-content-center align-items-center">
                    <img src="<?= htmlspecialchars(_GALERY_IMG_PATH_ . $image, ENT_QUOTES, 'UTF-8'); ?>" class="rounded-lg-3" alt="<?= htmlspecialchars($car['marque'], ENT_QUOTES, 'UTF-8'); ?>" width="40%">
                    <a href="#" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?')" class="position-absolute top-50 start-50 translate-middle" style="font-size: 10vw;">
                        <i class="bi bi-trash text-danger"></i>
                    </a>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <input type="submit" value="Enregistrer les modifications" name="updateCar" class="btn btn-primary" onclick="return confirm('Êtes-vous sûr de vouloir modifier cette annonce ?')">
    <input type="submit" value="Supprimer l'annonce" name="deleteCar" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">
</form>