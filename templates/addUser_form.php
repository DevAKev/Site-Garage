<section id="formulaire">
    <!-- Formulaire d'inscription-->
    <div class="container d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <h2 class="p-4 mt-4"> Formulaire d'inscription </h2>
        <?php foreach ($messages as $message) { ?>
            <div class="alert alert-success"><?= $message; ?>
            </div>
        <?php } ?>
        <?php foreach ($errors as $error) { ?>
            <div class="alert alert-danger"><?= $error; ?>
            </div>
        <?php } ?>
        <form method="POST" enctype="multipart/form-data" class="row g-3" id="lessonForm" novalidate>
            <div class="col-md-6">
                <label for="firstName" class="form-label">Prénom * </label>
                <input type="text" class="form-control" name="firstName" id="firstName">
                <div class="invalid-feedback">
                    Veuillez saisir votre prénom.
                </div>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">Nom * </label>
                <input type="text" class="form-control" name="lastName" id="lastName" required>
                <div class="invalid-feedback">
                    Veuillez saisir votre nom.
                </div>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail *</label>
                <input type="email" class="form-control" name="email" id="email" required>
                <div class="invalid-feedback">
                    Veuillez saisir votre e-mail.
                </div>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Votre mot de passe *</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <div class="invalid-feedback">
                    Veuillez saisir votre mot de passe.
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3 form-check">
                    <label class="form-check-label" for="conditions">J'accepte les conditions*</label>
                    <input type="checkbox" class="form-check-input" id="conditions" name="conditions">
                    <div class="invalid-feedback">
                        Merci de lire les conditions avant de valider le formulaire.
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-block">
                <input type="submit" value="Inscription" name="addUser" class="btn btn-primary btn-lg">
            </div>
        </form>
        <div id="toast" class="toast"></div>
    </div>
</section>