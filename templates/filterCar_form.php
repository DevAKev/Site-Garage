<form action="" method="GET" class="form-control p-4">
    <select name="marque" class="form-select mb-3">
        <option value="" selected>Marques</option>
        <?php foreach ($marques as $marqueOption) { ?>
            <option value="<?= $marqueOption ?>" <?= $marque === $marqueOption ? 'selected' : '' ?>><?= $marqueOption ?></option>
        <?php } ?>
    </select>
    <select name="carburant" id="fuel-type" class="form-select mb-3">
        <option value="" selected>Carburant</option>
        <?php foreach ($carburants as $carburantOption) { ?>
            <option value="<?= $carburantOption ?>" <?= $carburant === $carburantOption ? 'selected' : '' ?>><?= $carburantOption ?></option>
        <?php } ?>
    </select>
    <label for="price">Prix :</label>
    <div id="price-slider" class="mb-3"></div>
    <input type="hidden" id="minPrice" name="minPrice" value="<?= $minPrice ?>">
    <input type="hidden" id="maxPrice" name="maxPrice" value="<?= $maxPrice ?>">
    <div id="price-values"></div>
    <hr class="divider">
    <br>
    <label for="kilometrage">Kilométrage :</label>
    <div id="kilometrage-slider" class="mb-3"></div>
    <input type="hidden" id="minkilometrage" name="minkilometrage" value="<?= $minkilometrage ?>">
    <input type="hidden" id="maxkilometrage" name="maxkilometrage" value="<?= $maxkilometrage ?>">
    <div id="kilometrage-values"></div>
    <hr class="divider">
    <br>
    <label for="annee">Années :</label>
    <div id="annee-slider" class="mb-3"></div>
    <input type="hidden" id="minAnnee" name="minAnnee" value="<?= $minAnnee ?>">
    <input type="hidden" id="maxAnnee" name="maxAnnee" value="<?= $maxAnnee ?>">
    <div id="annee-values"></div>
    <hr class="divider">
    <br>
    <button type="submit" class="btn btn-warning m-2" name="reset" value="true">Réinitialiser</button>
    <button type="submit" class="btn btn-primary m-2">Filtrer</button>
</form>