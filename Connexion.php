<?php

require_once('templates/header.php');

$errors = [];
$messages = [];

if (isset($_POST['loginUser'])) {

    $query = $pdo->prepare("SELECT * FROM administrateur WHERE email = :email");
    $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if ($user && $user['password'] === $_POST['password']) {
        $messages[] = 'Vous êtes connecté !';
    } else {
        $errors[] = 'Email ou mot de passe incorrect !';
    }
}
?>

<div id="background-image" class="container">
    <br>
    <h1> CONNEXION </h1>
</div>

<section id="formulaire">
    <!-- Formulaire de connexion -->
    <div class="container d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <h2 class="p-4 mt-4"> Formulaire de connexion </h2>
        <?php foreach ($messages as $message) { ?>
            <div class="alert alert-success"><?= $message ?>
            </div>
        <?php } ?>

        <?php foreach ($errors as $error) { ?>
            <div class="alert alert-danger"><?= $error ?>
            </div>
        <?php } ?>
        <form method="POST" enctype="multipart/form-data" class="row" id="formConnect" novalidate>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
                <div class="invalid-feedback">
                    Veuillez saisir votre adresse email.
                </div>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <div class="invalid-feedback">
                    Veuillez saisir votre mot de passe.
                </div>
            </div>
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-primary p-2 mt-4 mb-2" type="submit" value="Connexion" name="loginUser">Se connecter</button>
            </div>
            <p> Pas encore inscrit ? Contacter l'administrateur <a href="mailto:kevynpro7700@gmail.com?subject=Demande%20d'information&body=Bonjour%2C%20j'aimerais%20obtenir%20des%20informations%20supplémentaires."> Cliquez-ici</a></p>
        </form>
        <div id="toast" class="toast"></div>
    </div>
</section>


<!-- FOOTER START -->
<!-- <script type="module" src="assets/JS/connexion.js"> </script> -->
<?php
require_once __DIR__ . ('/templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
require_once __DIR__ . ('/lib/scripts.php');
?>