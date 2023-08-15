<?php
// RECUPERATION DES MESSAGES DE LA BASE DE DONNEES
function getMessages(PDO $pdo, int $limit = null)
{
    $sql = 'SELECT * FROM contact_messages ORDER BY id DESC';
    if ($limit !== null) {
        $sql .= ' LIMIT :limit';
    }
    $query = $pdo->prepare($sql);
    if ($limit !== null) {
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
    }
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// INSERTION D'UN MESSAGE DANS LA BASE DE DONNEES
function insertMessage(PDO $pdo, $nom, $prenom, $email, $phone_number, $message, $date, $status, $objet)
{
    $sql = 'INSERT INTO contact_messages (nom, prenom, email, phone_number, message, date, status, objet) VALUES (:nom, :prenom, :email, :phone_number, :message, :date, :status, :objet)';
    $query = $pdo->prepare($sql);

    $query->bindValue(':nom', $nom, PDO::PARAM_STR);
    $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
    $query->bindValue(':message', $message, PDO::PARAM_STR);
    $query->bindValue(':date', $date, PDO::PARAM_STR);
    $query->bindValue(':status', $status, PDO::PARAM_STR);
    $query->bindValue(':objet', $objet, PDO::PARAM_STR);
    try {
        $query->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion du message : " . $e->getMessage();
        return false;
    }
}

// MISE À JOUR DU STATUT D'UN MESSAGE DANS LA BASE DE DONNÉES
function updateMessageStatus(PDO $pdo, int $id, string $status)
{
    $sql = 'UPDATE contact_messages SET status = :status WHERE id = :id';
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->bindValue(':status', $status, PDO::PARAM_STR);
    try {
        $query->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour du statut du message : " . $e->getMessage();
        return false;
    }
}

// SUPPRESSION D'UN MESSAGE DE LA BASE DE DONNEES
function deleteMessage(PDO $pdo, int $id)
{
    $sql = 'DELETE FROM contact_messages WHERE id = :id';
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    try {
        $query->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression du message : " . $e->getMessage();
        return false;
    }
}

// RECUPERE LE NOMBRE DE MESSAGES NON LUS POUR AFFICHER LA NOTIFICATION
function getUnreadMessageCount(PDO $pdo)
{
    $sql = "SELECT COUNT(*) AS unread_count FROM contact_messages WHERE status = 'non lu'";
    $query = $pdo->query($sql);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['unread_count'];
}

// RECUPERER LES MESSAGES EN FONCTION DE ID
function getMessageById(PDO $pdo, int $id)
{
    $query = $pdo->prepare("SELECT * FROM contact_messages WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}
