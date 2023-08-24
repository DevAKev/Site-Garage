<?php

// RECUPERER LES AVIS EN AFFICHANT LES DERNIERS EN PREMIER
function getReviews(PDO $pdo, int $limit = null)
{
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

// INSÉRER UN AVIS DANS LA BASE DE DONNÉES
function insertReview(PDO $pdo, string $name, string $commentaire, int $note)
{
    if ($note < 1 || $note > 5) {
        throw new InvalidArgumentException("La note doit être comprise entre 1 et 5.");
    }
    $sql = 'INSERT INTO customer_reviews (name, commentaire, note, publish) VALUES (:name, :commentaire, :note, 0)';
    $query = $pdo->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $query->bindParam(':note', $note, PDO::PARAM_INT);
    return $query->execute();
}

// MAJ COMMENTAIRE
function updateReview(PDO $pdo, int $reviewId, string $name, string $commentaire, int $note)
{
    if ($note < 1 || $note > 5) {
        throw new InvalidArgumentException("La note doit être comprise entre 1 et 5.");
    }
    $sql = 'UPDATE customer_reviews SET name = :name, commentaire = :commentaire, note = :note WHERE id = :reviewId';
    $query = $pdo->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $query->bindParam(':note', $note, PDO::PARAM_INT);
    $query->bindParam(':reviewId', $reviewId, PDO::PARAM_INT);
    return $query->execute();
}

// RECUPERER LES AVIS PUBLIES
function getPublishImportReviews(PDO $pdo, int $limit = null)
{
    $sql = 'SELECT * FROM customer_reviews WHERE publish = 1 ORDER BY RAND() DESC';
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

// MAJ DES AVIS PUBLIÉS
function updatePublishReviews(PDO $pdo, int $reviewId, int $publish)
{
    $sql = 'UPDATE customer_reviews SET publish = :publish WHERE id = :reviewId';
    $query = $pdo->prepare($sql);
    $query->bindParam(':publish', $publish, PDO::PARAM_INT);
    $query->bindParam(':reviewId', $reviewId, PDO::PARAM_INT);
    return $query->execute();
}

// SUPPRIMER UN COMMENTAIRE
function deleteReview(int $Id)
{
    global $pdo;
    $sql = 'DELETE FROM customer_reviews WHERE id = :Id';
    $query = $pdo->prepare($sql);
    $query->bindParam(':Id', $Id, PDO::PARAM_INT);
    if ($query->execute()) {
        return true;
    } else {
        return false;
    }
}

// RECUPERER LES DONNEES D'UN AVIS PAR SON ID
function getReviewById(PDO $pdo, int $id)
{
    $query = $pdo->prepare("SELECT * FROM customer_reviews WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

// RECUPERER LE NOMBRE D'AVIS
function getTotalReviews(PDO $pdo): int
{
    $sql = "SELECT COUNT(*) as total FROM customer_reviews";
    $query = $pdo->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

// RECUPERE LE NOMBRE D'AVIS NON VERIFIE POUR AFFICHER LA NOTIFICATION
function getUnverifiedReviewCount(PDO $pdo)
{
    $sql = "SELECT COUNT(*) AS unverified_count FROM customer_reviews WHERE publish = 0";
    $query = $pdo->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['unverified_count'];
}
