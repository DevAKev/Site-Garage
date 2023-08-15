    <form action="" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $review['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="commentaire" class="form-label">Commentaire</label>
            <textarea class="form-control" id="commentaire" name="commentaire" required><?= $review['commentaire']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="note">Note (entre 1 et 5) :</label>
            <select id="note" name="note" required>
                <option value="" disabled selected>Choisissez une note</option>
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <option value="<?php echo $i; ?>">
                        <?php echo str_repeat('★', $i) . str_repeat('☆', 5 - $i); ?>
                    </option>
                <?php endfor; ?>
            </select><br>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>