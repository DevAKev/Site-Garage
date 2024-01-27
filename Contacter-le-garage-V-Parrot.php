<?php
require_once('lib/session.php');
require_once('lib/pdo.php');
require_once('templates/header.php');
require_once('lib/contact_tools.php');

$messages = [];
$errors = [];

// VERIFIER SI LE FORMULAIRE A ETE ENVOYE
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
    $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $phone_number = htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8');
    $message_text = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
    $date = date('Y-m-d H:i:s'); // Date actuelle
    $status = 'non lu'; // Statut initial
    $objet = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');

    // Validation des champs RegEX
    require_once('lib/validateFieldsContactForm.php');
}
?>

<!-- FIL D'ARIANE -->
<nav aria-label="breadcrumb" class="mt-5 pt-5">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contactez-nous</li>
        </ol>
    </div>
</nav>

<!-- FORMULAIRE DE CONTACT -->
<section class="container py-5">
    <h2 class="text-center mb-5">Fiche de contact</h2>
    <?php foreach ($messages as $message) { ?>
        <div class="alert alert-success"><?= $message ?>
        </div>
    <?php } ?>

    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger"><?= $error ?>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-8 mx-auto p-4">
            <?php require_once 'templates/contact_form.php'; ?>
        </div>
    </div>
</section>

<a href="cars.php" class="btn btn-secondary">Retourner à la liste des véhicules</a>

<!-- BUTTON BACK TO TOP -->
<div class="back-to-top-container p-4">
    <div class="back-to-top">
        <div class="btn btn-primary">
            <a href="Contacter-le-garage-V-Parrot.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- FOOTER START -->
<?php
require_once __DIR__ . ('/templates/footer.php');
// FOOTER END
?>