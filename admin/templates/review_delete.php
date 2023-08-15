<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/header.php";
require_once __DIR__ . "/../../lib/reviews_tools.php";

$review = false;
$errors = [];
$messages = [];

if (isset($_GET['id'])) {
    $reviewId = intval($_GET['id']);

    $review = getReviewById($pdo, $reviewId);

    if ($review) {
        $deleted = deleteReview($reviewId);

        if ($deleted) {
            // SUPPRESSION REUSSIE
            $messages[] = "L'avis a été supprimé avec succès.";
        } else {
            // ERREUR LORS DE LA SUPPRESSION
            $errors[] = "Une erreur s'est produite lors de la suppression de l'avis.";
        }
    } else {
        // L'AVIS N'EXISTE PAS
        $errors[] = "Cet avis n'existe pas.";
    }
}
?>
<h1>Suppression d'un avis</h1>

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
<a href="reviews.php" class="btn btn-secondary">Retourner à la liste des avis</a>
<?php
require_once __DIR__ . ("/footer.php");
?>