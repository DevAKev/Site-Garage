<?php
require_once('templates/header.php');
require_once('lib/pdo.php');
require_once('lib/reviews_tools.php');

$messages = [];
$errors = [];

$review = [
    'name' => '',
    'commentaire' => '',
    'note' => '',
    'published' => ''
];

// VERIFIER SI LE FORMULAIRE A ETE ENVOYE
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $commentaire = $_POST["commentaire"];
    $note = intval($_POST["note"]);

    if (empty($name)) {
        $errors[] = "Le nom est obligatoire !";
    }

    if (empty($commentaire)) {
        $errors[] = "Le commentaire est obligatoire !";
    }
    // VERIFIER VALIDITE DE LA NOTE (Entre 1 et 5)
    if (empty($_POST['note'])) {
        $errors[] = "La note est obligatoire !";
    } elseif (!filter_var($_POST['note'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5]])) {
        $errors[] = "La note doit être un entier entre 1 et 5 !";
    } else {
        // APPELER LA FONCTION D'INSERTION D'UN AVIS
        $success = insertReview($pdo, $name, $commentaire, $note);
        if ($success) {
            $messages[] = "Votre avis a bien été enregistré. Merci pour votre contribution !";
            $review = [
                'name' => '',
                'commentaire' => '',
                'note' => '',
                'published' => ''
            ];
        } else {
            $errors[] = "Une erreur s'est produite lors de l'enregistrement de l'avis. Veuillez réessayer.";
        }
    }
}
?>

<body>
    <div class="container p-4 m-4">
        <h1 class="display-5 fw-bold text-body-emphasis">Laissez votre avis sur le garage et les prestations :</h1>
        <form action="add_reviews.php" method="post">
            <label for="name">Votre nom :</label>
            <input type="text" id="name" name="name" required><br>
            <label for="commentaire">Votre commentaire :</label><br>
            <textarea id="commentaire" name="commentaire" rows="4" cols="50" required></textarea><br>
            <!-- SYSTEME DE NOTATION AVEC LES ETOILES -->
            <label for="note">Note (entre 1 et 5) :</label>
            <select id="note" name="note" required>
                <option value="" disabled selected>Choisissez une note</option>
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <option value="<?php echo $i; ?>">
                        <?php echo str_repeat('★', $i) . str_repeat('☆', 5 - $i); ?>
                    </option>
                <?php endfor; ?>
            </select><br>
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