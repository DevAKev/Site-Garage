<?php

require_once('templates/header.php');
require_once('lib/user.php');

$errors = [];
$messages = [];

if (isset($_POST['addUser'])) {
    $res = addUser($pdo, $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password']);

    if ($res) {
        $messages[] = 'Votre inscription a bien été prise en compte !';
    } else {
        $errors[] = 'Une erreur est survenue lors de l\'inscription !';
    }
}

?>
<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima cum at voluptatibus odio facere doloribus, quasi quidem, dolorum nisi assumenda nesciunt a, quod eius rem aspernatur! Inventore magni accusantium doloribus neque, corrupti dolor tempore dolorem ipsa velit, similique dignissimos impedit, voluptatum modi iusto? Possimus maxime eius aspernatur hic beatae ad fugiat eos voluptatibus ducimus doloribus nobis aperiam impedit perferendis, assumenda quia consequuntur. Laborum est facere odio odit, neque libero, vero tempora dolorem placeat nesciunt quidem amet? Quia, officia expedita. Suscipit quasi dolor assumenda magnam praesentium, quidem exercitationem saepe? Consequatur quia neque perspiciatis unde beatae adipisci similique, qui velit asperiores praesentium, veritatis enim autem animi dolorum voluptate recusandae ipsum iure laboriosam rerum sunt. Rem qui delectus veritatis libero odit, laudantium ducimus alias hic quae quo at voluptas enim necessitatibus, optio quibusdam perspiciatis possimus illum harum voluptate eaque cupiditate modi atque labore. Temporibus illo, nobis cum voluptatem dolores porro consectetur voluptatum minima voluptates, veniam quae, quia aperiam tempora culpa ipsum excepturi veritatis iure consequatur nulla vero corporis? Quas repellat explicabo beatae quo quaerat enim corrupti, doloremque reiciendis cupiditate laudantium itaque quae qui quibusdam vitae eos rem commodi nam similique, dicta at! Nobis dignissimos dolorem sapiente, quidem placeat delectus commodi, sint, ut illo id dolor? Aperiam aut facere molestiae natus illum excepturi autem enim accusantium error in, ipsam explicabo, minus perferendis, maxime quod fuga suscipit soluta et ut? Eum sint labore iste nam cum sapiente? Molestiae voluptatem dolores culpa explicabo? Nobis sapiente, maxime soluta ex quas iste perspiciatis repellat? Facere, laudantium necessitatibus? Minus laborum quis iure suscipit accusamus. Rem quidem vel illo assumenda. Quas nam doloremque nisi laborum beatae voluptatum accusantium numquam commodi tempore repudiandae, praesentium veritatis. Dolor sed aliquam a assumenda, in animi deleniti consequuntur amet eligendi vel delectus, fugiat enim exercitationem est expedita beatae quod voluptatibus maxime commodi, qui id debitis ab. Odit odio, officia quasi ut inventore, ratione quod quibusdam accusantium qui cumque officiis ipsa tenetur quaerat nesciunt, repellat incidunt facilis nemo impedit? Veniam, dicta non error unde consequatur reiciendis exercitationem quibusdam praesentium tenetur magni ab reprehenderit quaerat maiores itaque! Laborum dolorem quas quidem, veritatis omnis minima, dolorum adipisci, temporibus rem maxime natus eaque numquam aut sed iusto voluptatem ullam? Quisquam neque autem enim, fuga quia dignissimos aspernatur id, explicabo incidunt fugiat necessitatibus, animi iusto? Corporis dicta accusantium deleniti quaerat perspiciatis illum aspernatur sit ad minus ipsa. In suscipit nesciunt reprehenderit voluptatem commodi odio excepturi est pariatur? Harum, nam ab?</p>
<div id="img-inscription">
    <h1> INSCRIPTION </h1>
</div>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success"><?= $message; ?>
    </div>
<?php } ?>

<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"><?= $error; ?>
    </div>
<?php } ?>

<section id="formulaire">
    <!-- Formulaire d'inscription-->
    <div class="container d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <h2 class="p-4 mt-4"> Formulaire d'inscription </h2>
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
            <!-- <div class="col-md-6">
                <label for="phoneNumber" class="form-label">Téléphone*</label>
                <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber">
                <div class="invalid-feedback">
                    Veuillez saisir votre numéro de téléphone.
                </div>
            </div> -->
            <!-- <div class="col-md-6">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" class="form-control" name="address" id="address">
            <div class="invalid-feedback">
                Veuillez saisir votre adresse.
            </div>
        </div>
        <div class="col-md-6">
            <label for="city" class="form-label">Ville</label>
            <input type="text" class="form-control" name="city" id="city" required>
            <div class="invalid-feedback">
                Veuillez choisir une ville.
            </div>
        </div>
        <div class="col-md-6">
            <label for="postCode" class="form-label">Code postal</label>
            <input type="text" class="form-control" name="postCode" id="postCode">
            <div class="invalid-feedback">
                Veuillez saisir votre code postal.
            </div>
        </div> -->
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
            <p>Déjà inscrit ? <a href="Connexion.php">Cliquez-ici</a></p>
        </form>
        <!-- <div id="toast" class="toast"></div> -->
    </div>
</section>
</header>

<!-- FOOTER START -->
<?php
require_once __DIR__ . ('/templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
require_once __DIR__ . ('/lib/scripts.php');
?>
<!-- <script type="module" src="assets/JS/main.js"></script> -->