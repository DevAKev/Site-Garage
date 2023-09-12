</div>
<section id="formulaire">
    <div class="container d-flex gap-2 flex-column min-vh-100 justify-content-center align-items-center">
        <?php foreach ($messages as $message) { ?>
            <div class="alert alert-success" role="alert">
                <?= $message; ?>
            </div>
        <?php } ?>
        <?php foreach ($errors as $error) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $error; ?>
            </div>
        <?php } ?>
        <form action="" method="post" enctype="multipart/form-data" class="row" id="formConnect">
            <h1 class="fw-bold p-2"> CONNEXION </h1>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
                <div class="invalid-feedback">
                    Veuillez saisir votre adresse email.
                </div>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password">
                <div class="invalid-feedback">
                    Veuillez saisir votre mot de passe.
                </div>
            </div>
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-primary mt-4 mb-2" type="submit" value="connexion" name="loginUser">Se connecter</button>
            </div>
        </form>
    </div>
</section>