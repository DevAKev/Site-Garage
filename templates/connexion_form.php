<h1> CONNEXION </h1>
</div>
<section id="formulaire">
    <div class="container d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <h2 class="p-4 mt-4"> Formulaire de connexion </h2>
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
                <button class="btn btn-primary p-2 mt-4 mb-2" type="submit" value="connexion" name="loginUser">Se connecter</button>
            </div>
        </form>
    </div>
</section>