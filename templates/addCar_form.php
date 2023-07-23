<!-- FORM START -->
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="marque" class="form-label">Marque : *</label>
        <input type="text" name="marque" id="marque" class="form-control" value="<?= htmlentities($car['marque']); ?>">
    </div>
    <div class="mb-3">
        <label for="modele" class="form-label">Modèle : *</label>
        <input type="text" name="modele" id="modele" class="form-control" value="<?= htmlentities($car['modele']); ?>">
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix : *</label>
        <input type="number" name="prix" id="prix"> €
    </div>
    <div class="mb-3">
        <label for="annee_mise_en_circulation">Année : *</label>
        <input type="number" name="annee_mise_en_circulation" id="annee_mise_en_circulation">
    </div>
    <div class="mb-3">
        <label for="kilometrage">Kilométrage : *</label>
        <input type="number" name="kilometrage" id="kilometrage">
    </div>
    <div class="mb-3">
        <label for="caracteristiques" class="form-label">Caracteristiques : *</label>
        <textarea name="caracteristiques" id="caracteristiques" cols="30" rows="5" class="form-control"><?= htmlentities($car['caracteristiques']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="equipements_options" class="form-label">Options du véhicule : </label>
        <textarea name="equipements_options" id="equipements_options" cols="10" rows="5" class="form-control"><?= htmlentities($car['equipements_options']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="carburant" class="form-label">Carburant : </label>
        <select name="carburant" id="carburant" class="form-select">
            <option value="Essence">Essence</option>
            <option value="Diesel">Diesel</option>
            <option value="Electrique">Electrique</option>
            <option value="Hybride">Hybride</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Photo Principale : </label>
        <input type="file" name="image" id="image">
    </div>
    <div class="mb-3">
        <label for="galerie_images" class="form-label">Autres Photos (maximum 3) :</label>
        <input type="file" name="galerie_images[]" id="galerie_images" accept="image/*" multiple>
    </div>
    <br>
    <input type="submit" value="Enregistrer" name="saveCar" class="btn btn-primary">
</form>