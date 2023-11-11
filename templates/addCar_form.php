<form id="addCarForm" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="marque" class="form-label">Marque : *</label>
        <input type="text" name="marque" id="marque" class="form-control" value="<?= htmlspecialchars($car['marque'], ENT_QUOTES, 'UTF-8'); ?>">
    </div>
    <div class="mb-3">
        <label for="modele" class="form-label">Modèle : *</label>
        <input type="text" name="modele" id="modele" class="form-control" value="<?= htmlspecialchars($car['modele'], ENT_QUOTES, 'UTF-8'); ?>">
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix : *</label>
        <input type="number" name="prix" id="prix" class="form-control" value="<?= htmlspecialchars($car['prix'], ENT_QUOTES, 'UTF-8'); ?>">
    </div>
    <div class="mb-3">
        <label for="annee_mise_en_circulation" class="form-label">Année de mise en circulation : *</label>
        <input type="number" name="annee_mise_en_circulation" id="annee_mise_en_circulation" class="form-control" value="<?= htmlspecialchars($car['annee_mise_en_circulation'], ENT_QUOTES, 'UTF-8'); ?>">
    </div>
    <div class="mb-3">
        <label for="kilometrage" class="form-label">Kilométrage : *</label>
        <input type="number" name="kilometrage" id="kilometrage" class="form-control" value="<?= htmlspecialchars($car['kilometrage'], ENT_QUOTES, 'UTF-8'); ?>">
    </div>
    <div class="mb-3">
        <label for="caracteristiques" class="form-label">Caracteristiques : *</label>
        <textarea name="caracteristiques" id="caracteristiques" cols="30" rows="5" class="form-control"><?= htmlspecialchars($car['caracteristiques'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        <!-- CHARACTER COUNTER LIMITED TO 500 -->
        <span id="caracteristiques-counter">0/500</span>
    </div>
    <div class="mb-3">
        <label for="equipements_options" class="form-label">Options du véhicule : </label>
        <textarea name="equipements_options" id="equipements_options" cols="30" rows="5" class="form-control"><?= htmlspecialchars($car['equipements_options'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        <!-- CHARACTER COUNTER LIMITED TO 500 -->
        <span id="equipements_optionsCounter">0/500</span>
    </div>
    <!-- LIST DIFFERENT TYPES OF FUELS -->
    <div class="mb-3">
        <label for="carburant" class="form-label">Carburant : </label>
        <select name="carburant" id="carburant" class="form-select">
            <option value="Essence">Essence</option>
            <option value="Diesel">Diesel</option>
            <option value="Electrique">Electrique</option>
            <option value="Hybride">Hybride</option>
        </select>
    </div>
    <!-- FIELD FOR MAIN IMAGE -->
    <div class="mb-3">
        <label for="image" class="form-label">Photo Principale : </label>
        <input type="file" name="image" id="image" class="form-control">
    </div>

    <!-- FIELD FOR IMAGES GALLERY -->
    <div class="mb-3">
        <label for="galerie_images" class="form-label">Autres Photos (maximum 3) :</label>
        <input type="file" name="galerie_images[]" id="galerie_images" accept="image/*" class="form-control" multiple>
    </div>
    <br>
    <input type="submit" value="Enregistrer" name="saveCar" class="btn btn-primary">
</form>