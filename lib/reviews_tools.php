<?php
require_once('pdo.php');

// INSÉRER UN AVIS DANS LA BASE DE DONNÉES
function insertReview(PDO $pdo, string $name, string $commentaire, int $note)
{
    // Vérifier que la note est valide (entre 1 et 5)
    if ($note < 1 || $note > 5) {
        throw new InvalidArgumentException("La note doit être comprise entre 1 et 5.");
    }
    $sql = 'INSERT INTO customer_reviews (name, commentaire, note) VALUES (:name, :commentaire, :note)';
    $query = $pdo->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $query->bindParam(':note', $note, PDO::PARAM_INT);
    return $query->execute();
}

// RÉCUPÉRER LES AVIS UTILISATEURS POUR L'APERÇU SUR LA PAGE D'ACCUEIL
function getReviewsForIndex(PDO $pdo, int $limit = null)
{

    $sql = 'SELECT * FROM customer_reviews WHERE publish = 1 ORDER BY id DESC LIMIT :limit';
    $query = $pdo->prepare($sql);
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
}

// RECUPERE LES ELEMENTS DE LA TABLE CUSTOMER_REVIEWS
function getReviewsById(int $id)
{
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM customer_reviews WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

// LIMITE DE COMMENTAIRES A AFFICHER
function getLimitReviews(int $limit = null)
{
    global $pdo;

    $sql = 'SELECT * FROM customer_reviews ORDER BY id DESC';

    if ($limit) {
        $sql .= ' LIMIT :limit';
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll();
}

// AFFICHER LES COMMENTAIRES PUBLIES EN AFFICHANT LES DERNIERS
function getPublishedReviews(int $limit = null)
{

    global $pdo;

    $sql = 'SELECT * FROM customer_reviews 1 ORDER BY id DESC';

    if ($limit) {
        $sql .= ' LIMIT :limit';
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll();
}

// SUPPRIMER UN COMMENTAIRE
function deleteReviews(int $Id)
{
    global $pdo;
    $sql = 'DELETE FROM customer_reviews WHERE id = :Id';

    $query = $pdo->prepare($sql);
    $query->bindParam(':Id', $Id, PDO::PARAM_INT);

    if ($query->execute()) {
        // Suppression réussie
        return true;
    } else {
        // Erreur lors de la suppression
        return false;
    }
}

// MAJ COMMENTAIRE
function updateReviews(int $reviewId, int $publish)
{
    global $pdo;
    $sql = 'UPDATE customer_reviews SET publish = :publish WHERE id = :reviewId';

    $query = $pdo->prepare($sql);
    $query->bindParam(':publish', $publish, PDO::PARAM_INT);
    $query->bindParam(':reviewId', $reviewId, PDO::PARAM_INT);

    return $query->execute();
}

if (isset($_GET['error']) && $_GET['error'] === '1') {
    // Afficher un message d'erreur
    echo '<div class="alert alert-danger" role="alert">Une erreur s\'est produite lors de la mise à jour de l\'utilisateur.</div>';
}

// Enregistrer les données saisies dans le formulaire de modération
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reviewId']) && isset($_POST['publish'])) {
    $reviewId = intval($_POST['reviewId']);
    $publish = intval($_POST['publish']);

    // Appel de la fonction pour mettre à jour l'état de publication de l'avis
    $result = updateReviews($reviewId, $publish);

    if ($result) {
        echo "Mise à jour réussie !";
    } else {
        echo "Erreur lors de la mise à jour de l'avis.";
    }
}
