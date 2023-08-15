<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre *</label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?= $service['titre']; ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description *</label>
        <textarea class="form-control" id="description" name="description" rows="8"><?= $service['description']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="categorie" class="form-label">Catégorie *</label>
        <select name="categorie_id" id="categorie" class="form-select">
            <?php foreach ($categories as $categorie) { ?>
                <option value="<?= $categorie['id'] ?>" <?php if ($service['categorie_id'] == $categorie['id']) { ?>selected="selected" <?php }; ?>><?= $categorie['title'] ?></option>
            <?php } ?>
        </select>
    </div>

    <?php if (isset($_GET['id']) && isset($service['image'])) { ?>
        <p>
            <img src="<?= _ASSETS_IMG_PATH_ . $service['image'] ?>" alt="<?= $service['titre'] ?>" width="100">
            <label for="delete_image">Supprimer l'image</label>
            <input type="checkbox" name="delete_image" id="delete_image">
            <input type="hidden" name="image" value="<?= $service['image']; ?>">
        </p>
    <?php } ?>
    <p>
        <input type="file" name="file" id="file">
    </p>
    <input type="submit" name="saveService" class="btn btn-primary" value="Enregistrer">
</form>