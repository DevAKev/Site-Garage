<?php

// FONCTION D'INSERTION D'UN UTILISATEUR
function addUser(PDO $pdo, string $firstName, string $lastName, string $email, string $password)
{
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si l'utilisateur existe déjà
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $existUser = $query->fetch();

    // Si l'utilisateur existe déjà, retourner false
    if ($existUser) {
        return false;
    }

    // Insérer l'utilisateur dans la BDD
    $sql = 'INSERT INTO users (password_hash, email, nom, prenom, role) VALUES (:password_hash, :email, :nom, :prenom, :role)';
    $query = $pdo->prepare($sql);

    $role = 'employe';
    $query->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':nom', $lastName, PDO::PARAM_STR);
    $query->bindParam(':prenom', $firstName, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

    return $query->execute();
}

// FONCTION DE MODIFICATION D'UN UTILISATEUR
function updateUser(PDO $pdo, int $userId, string $firstName, string $lastName, string $email, string $password)
{
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'UPDATE users SET prenom = :firstName, nom = :lastName, email = :email, password_hash = :password_hash WHERE id = :userId';
    } else {
        $sql = 'UPDATE users SET prenom = :firstName, nom = :lastName, email = :email WHERE id = :userId';
    }

    $query = $pdo->prepare($sql);

    $query->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $query->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);

    if (!empty($password)) {
        $query->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
    }

    return $query->execute();
}

// FONCTION DE SUPPRESSION D'UN UTILISATEUR
function deleteUser(PDO $pdo, int $userId)
{
    $sql = 'DELETE FROM users WHERE id = :userId';

    $query = $pdo->prepare($sql);
    $query->bindParam(':userId', $userId, PDO::PARAM_INT);

    if ($query->execute()) {
        // Suppression réussie
        return true;
    } else {
        // Erreur lors de la suppression
        return false;
    }
}

// FONCTION DE CONNEXION D'UN UTILISATEUR
function login($email, $password, $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Preparing the request to prevent SQL injection
        $requete = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->execute();
        // Use fetch(PDO::FETCH_ASSOC) to get associative array
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        // Vérification du mot de passe
        if ($user && password_verify($password, $user['password_hash'])) {
            // MAJ LAST CONNEXION
            $updateQuery = $pdo->prepare("UPDATE users SET last_connexion = :last_connexion WHERE id = :id");
            $lastConnexion = date('Y-m-d H:i:s');
            $updateQuery->bindParam(':last_connexion', $lastConnexion, PDO::PARAM_STR);
            $updateQuery->bindParam(':id', $user['id'], PDO::PARAM_INT);
            $updateQuery->execute();
            // User informations in session
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['role'] = $user['role'];
            $_SESSION['user']['nom'] = $user['nom'];
            $_SESSION['user']['prenom'] = $user['prenom'];
            // Regenerate session id to prevent session fixation
            session_regenerate_id();
            return true;
        }
    }
    return false;
}

// RECUPERER LES DONNEES D'UN UTILISATEUR PAR SON EMAIL
function getUserByEmail(PDO $pdo, string $email)
{
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
}

function getUsers(PDO $pdo, int $limit = null)
{
    $sql = 'SELECT * FROM users ORDER BY id DESC';
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

// RECUPERER TOUS LES UTILISATEURS
function getTotalUsers(PDO $pdo): int
{
    $sql = "SELECT COUNT(*) as total FROM users";

    $query = $pdo->prepare($sql);

    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}

// RECUPERER LES UTILISATEURS EN FONCTION DE ID
function getUserById(PDO $pdo, int $id)
{
    $query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
}
