<form id="filterForm" method="GET" class="form-control p-4">
    <select id="marque" name="marque" class="form-select">
        <option value="" <?= empty($marque) ? 'selected' : '' ?>>Marques</option>
        <?php foreach ($marques as $marqueOption) { ?>
            <option value="<?= $marqueOption ?>" <?= $marque === $marqueOption ? 'selected' : '' ?>><?= $marqueOption ?></option>
        <?php } ?>
    </select>
    <select name="carburant" id="fuel-type" class="form-select mb-2">
        <option value="" <?= empty($carburant) ? 'selected' : '' ?>>Carburant</option>
        <?php foreach ($carburants as $carburantOption) { ?>
            <option value="<?= $carburantOption ?>" <?= $carburant === $carburantOption ? 'selected' : '' ?>><?= $carburantOption ?></option>
        <?php } ?>
    </select>
    <label for="price" class="mb-2">Prix :</label>
    <div id="price-slider"></div>
    <input type="hidden" id="minPrice" name="minPrice" value="<?= $minPrice ?>">
    <input type="hidden" id="maxPrice" name="maxPrice" value="<?= $maxPrice ?>">
    <div id="price-values"></div>
    <br>
    <label for="kilometrage" class="mb-2">Kilométrage :</label>
    <div id="kilometrage-slider"></div>
    <input type="hidden" id="minkilometrage" name="minkilometrage" value="<?= $minkilometrage ?>">
    <input type="hidden" id="maxkilometrage" name="maxkilometrage" value="<?= $maxkilometrage ?>">
    <div id="kilometrage-values"></div>
    <br>
    <label for="annee" class="mb-2">Années :</label>
    <div id="annee-slider"></div>
    <input type="hidden" id="minAnnee" name="minAnnee" value="<?= $minAnnee ?>">
    <input type="hidden" id="maxAnnee" name="maxAnnee" value="<?= $maxAnnee ?>">
    <div id="annee-values"></div>
    <button type="submit" class="btn btn-warning" name="reset" value="true">Réinitialiser</button>
    <!-- <button type="submit" class="btn btn-primary m-2">Filtrer</button> -->
    <?php include_once('templates/triCar_form.php'); ?>
</form>