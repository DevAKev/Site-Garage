<?php

// FONCTION D'INSERTION D'UN UTILISATEUR
function addUser(PDO $pdo, string $firstName, string $lastName, string $email, string $password)
{
    // VERIFIER SI L'UTILISATEUR EXISTE DEJA
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $existUser = $query->fetch();
    // SI L'UTILISATEUR EXISTE DEJA RETOURNE FALSE
    if ($existUser) {
        return false;
    }
    $sql = 'INSERT INTO `users` (`id`, `password_hash`, `email`, `nom`, `prenom`, `last_connexion`, `role`) VALUES (NULL, :password_hash, :email, :nom, :prenom, :role)';
    $query = $pdo->prepare($sql);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $role = 'employe';
    $query->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':nom', $firstName, PDO::PARAM_STR);
    $query->bindParam(':prenom', $lastName, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

    return $query->execute();
}

// FONCTION DE CONNEXION D'UN UTILISATEUR
function login($email, $password, $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $requete = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->execute();

        $user = $requete->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            return true;
        } else {
            return false;

            // MAJ DE LA DATE DE DERNIERE CONNEXION
            $updateQuery = $pdo->prepare("UPDATE users SET last_connexion = :last_connexion WHERE id = :id");
            $updateQuery->bindParam(':last_connexion', date('Y-m-d H:i:s'));
            $updateQuery->bindParam(':id', $user['id'], PDO::PARAM_INT);
            $updateQuery->execute();

            return true;
        }
    }

    return false;
}

// GESTION DES AVIS START
//Rajouter une limites de commentaire à afficher
// function getImportComments(PDO $pdo, int $limit = null)
// {
//   $sql = 'SELECT * FROM OpinionsTable ORDER BY id DESC';

//   if ($limit) {
//     $sql .= ' LIMIT :limit';
//   }

//   $query = $pdo->prepare($sql);

//   if ($limit) {
//     $query->bindParam(':limit', $limit, PDO::PARAM_INT);
//   }

//   $query->execute();
//   return $query->fetchAll();
// }

// function getPublishedImportOpinions(PDO $pdo, int $limit = null)
// {
//   $sql = 'SELECT * FROM OpinionsTable WHERE publish = 1 ORDER BY id DESC';

//   if ($limit) {
//     $sql .= ' LIMIT :limit';
//   }

//   $query = $pdo->prepare($sql);

//   if ($limit) {
//     $query->bindParam(':limit', $limit, PDO::PARAM_INT);
//   }

//   $query->execute();
//   return $query->fetchAll();
// }

// function deleteOpinions(PDO $pdo, int $Id)
// {
//   $sql = 'DELETE FROM OpinionsTable WHERE id = :Id';

//   $query = $pdo->prepare($sql);
//   $query->bindParam(':Id', $Id, PDO::PARAM_INT);

//   if ($query->execute()) {
//     // Suppression réussie
//     return true;
//   } else {
//     // Erreur lors de la suppression
//     return false;
//   }
// }

// function updateOpinionPublish(PDO $pdo, int $opinionId, int $publish)
// {
//   $sql = 'UPDATE OpinionsTable SET publish = :publish WHERE id = :opinionId';

//   $query = $pdo->prepare($sql);
//   $query->bindParam(':publish', $publish, PDO::PARAM_INT);
//   $query->bindParam(':opinionId', $opinionId, PDO::PARAM_INT);

//   return $query->execute();
// }

// if (isset($_GET['error']) && $_GET['error'] === '1') {
//   // Afficher un message d'erreur
//   echo '<div class="alert alert-danger" role="alert">Une erreur s\'est produite lors de la mise à jour de l\'utilisateur.</div>';
// }

// GESTION DES AVIS END
