<?php
require_once('templates/header.php');
require_once('lib/pdo.php');
require_once('lib/reviews_tools.php');

$messages = [];
$errors = [];

// VERIFIER SI LE FORMULAIRE A ETE ENVOYE
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $commentaire = $_POST["commentaire"];
    $note = intval($_POST["note"]);

    // VERIFIER VALIDITE DE LA NOTE (Entre 1 et 5)
    if ($note < 1 || $note > 5) {
        echo "La note doit être comprise entre 1 et 5.";
    } else {
        // APPELER LA FONCTION D'INSERTION D'UN AVIS
        $success = insertReview($pdo, $name, $commentaire, $note);

        if ($success) {
            $messages[] = "Votre avis a bien été enregistré. Merci pour votre contribution !";
        } else {
            $errors[] = "Une erreur s'est produite lors de l'enregistrement de l'avis. Veuillez réessayer.";
        }
    }
}
?>

<body>
    <div class="container p-4 m-4">
        <h1>Laissez votre avis sur le garage et les prestations :</h1>
        <form action="add_reviews.php" method="post">
            <label for="name">Votre nom :</label>
            <input type="text" id="name" name="name" required><br>

            <label for="commentaire">Votre commentaire :</label><br>
            <textarea id="commentaire" name="commentaire" rows="4" cols="50" required></textarea><br>

            <label for="note">Note (entre 1 et 5) :</label>
            <input type="number" id="note" name="note" min="1" max="5" required><br>

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
    </div>
    <a href="index.php" class="btn btn-secondary">Retourner sur la page d'accueil</a>
    <?php
    require_once('templates/footer.php');
    ?>