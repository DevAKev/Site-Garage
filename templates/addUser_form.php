<section id="formulaire">
    <!-- FORMULAIRE INSCRIPTION -->
    <form method="POST" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom *</label>
            <input type="text" class="form-control" name="prenom" id="prenom" value="<?= htmlspecialchars($user['prenom'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom *</label>
            <input type="text" class="form-control" name="nom" id="nom" value="<?= htmlspecialchars($user['nom'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail *</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <?php if ($action === 'modify') { ?>
            <button type="submit" class="btn btn-primary" name="modify">Modifier</button>
        <?php } else { ?>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe *</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add">Ajouter</button>
        <?php } ?>
    </form>
</section>