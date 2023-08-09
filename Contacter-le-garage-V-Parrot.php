<?php
require_once('templates/header.php');
?>

<!--Contenu de la page-->

<!-- Fil d'ariane -->
<nav aria-label="breadcrumb" class="mt-5 pt-5">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contactez-nous</li>
        </ol>
    </div>
</nav>

<!-- Formulaire de contact -->
<section class="container py-5">
    <h2 class="text-center mb-5">Fiche de contact</h2>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <form id="contact-form" method="post" action="contact-form-handler.php">
                <div class="messages"></div>
                <div class="controls">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Nom *</label>
                                <input id="form_name" type="text" name="name" class="form-control" placeholder="Entrez votre nom" required="required" data-error="Votre nom est requis.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Prénom </label>
                                <input id="form_prename" type="text" name="name" class="form-control" placeholder="Entrez votre prénom">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_number">Numéro *</label>
                            <input id="form_number" type="number" name="number" class="form-control" placeholder="Entrez votre numéro" required="required" data-error="Veuillez entrer un numéro de téléphone valide.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_email">Email *</label>
                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Entrez votre email" required="required" data-error="Veuillez entrer une adresse email valide.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Message *</label>
                            <textarea id="form_message" name="message" class="form-control" placeholder="Entrez votre message" rows="4" required="required" data-error="Veuillez entrer un message.">
                            </textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Envoyer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Map et informations de contact -->
<div class="col-md-6">
    <h3>Adresse</h3>
    <p>Garage V. Parrot</p>
    <p>123 rue des Garages</p>
    <p>75000 Paris</p>
    <h3>Téléphone</h3>
    <p>01 23 45 67 89</p>
</div>

<!-- BUTTON BACK TO TOP -->
<div class="back-to-top">
    <a href="Contacter-le-garage-V-Parrot.php">
        <button class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
            </svg>
        </button>
    </a>
</div>

<!-- FOOTER START -->
<?php
require_once __DIR__ . ('/templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
?>