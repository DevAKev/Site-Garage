<?php
require_once('templates/header.php');
require_once('lib/pdo.php');
require_once('lib/reviews_tools.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $commentaire = $_POST["commentaire"];
    $note = intval($_POST["note"]);

    // Vérifier que la note est valide (entre 1 et 5)
    if ($note < 1 || $note > 5) {
        echo "La note doit être comprise entre 1 et 5.";
    } else {
        // Appeler la fonction pour insérer l'avis dans la base de données
        $success = insertReview($pdo, $name, $commentaire, $note);

        if ($success) {
            echo "Votre avis a bien été enregistré. Merci pour votre contribution !";
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement de l'avis. Veuillez réessayer.";
        }
    }
}
?>

<body>
    <h1>Laissez votre avis sur le garage et les prestations :</h1>
    <form action="add_reviews.php" method="post">
        <label for="name">Votre nom :</label>
        <input type="text" id="name" name="name" required><br>

        <label for="commentaire">Votre commentaire :</label><br>
        <textarea id="commentaire" name="commentaire" rows="4" cols="50" required></textarea><br>

        <label for="note">Note (entre 1 et 5) :</label>
        <input type="number" id="note" name="note" min="1" max="5" required><br>

        <input type="submit" value="Envoyer">
    </form>

    <?php
    require_once('templates/footer.php');
    ?>
</body>

</html>