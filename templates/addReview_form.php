<form action="add_reviews.php" method="post">
    <label for="name">Votre nom :</label>
    <input type="text" id="name" name="name" required><br>
    <label for="commentaire">Votre commentaire :</label><br>
    <textarea id="commentaire" name="commentaire" rows="4" cols="50" required></textarea><br>
    <!-- SYSTEME DE NOTATION AVEC LES ETOILES -->
    <label for="note">Note (entre 1 et 5) :</label>
    <select id="note" name="note" required>
        <option value="" disabled selected>Choisissez une note</option>
        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <option value="<?php echo $i; ?>">
                <?php echo str_repeat('★', $i) . str_repeat('☆', 5 - $i); ?>
            </option>
        <?php endfor; ?>
    </select><br>
    <input type="submit" value="Envoyer">

    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success"><?= $message ?>
        </div>
    <?php } ?>

    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger"><?= $error ?>
        </div>
    <?php } ?>
</form>