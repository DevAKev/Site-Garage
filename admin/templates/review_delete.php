<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/header.php";
require_once __DIR__ . "/../../lib/reviews_tools.php";

$successMessage = "";
$errorMessage = "";

if (isset($_GET['id'])) {
    $reviewId = intval($_GET['id']);

    // Récupérer les informations de l'avis avant de le supprimer
    $review = getReviewById($pdo, $reviewId);

    if ($review) {
        $deleted = deleteReview($reviewId);

        if ($deleted) {
            // Suppression réussie, afficher un message de succès
            $successMessage = "L'avis a été supprimé avec succès.";
        } else {
            // Erreur lors de la suppression, afficher un message d'erreur
            $errorMessage = "Une erreur s'est produite lors de la suppression de l'avis.";
        }
    } else {
        // L'avis n'existe pas, afficher un message d'erreur
        $errorMessage = "Cet avis n'existe pas.";
    }
} else {
    // Rediriger vers la page de modération si l'id n'est pas spécifié
    $errorMessage = "Aucun avis spécifié pour la suppression.";
}
?>
<h1>Suppression d'un avis</h1>

<?php if (!empty($successMessage)) : ?>
    <div class="alert alert-success">
        <?= $successMessage; ?>
    </div>
<?php endif; ?>

<?php if (!empty($errorMessage)) : ?>
    <div class="alert alert-danger">
        <?= $errorMessage; ?>
    </div>
<?php endif; ?>
<a href="reviews.php" class="btn btn-secondary">Retourner à la liste des avis</a>
<?php
require_once __DIR__ . ("/footer.php");
?>