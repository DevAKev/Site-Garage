<?php
// CODE INSERTION ADMINISTRATEUR BDD
// if (isset($_POST["submit"])) {
//     // Récupérer les données du formulaire
//     $email = $_POST["email"];
//     $motDePasse = $_POST["password"];

// HACHAGE DU MOT DE PASSE
//     $motDePasseHache = password_hash($motDePasse, PASSWORD_BCRYPT);
//     var_dump($motDePasseHache);
// INSERTION DANS LA BDD     
//     $query = $pdo->prepare("INSERT INTO users (password_hash, email, nom, prenom, role) VALUES (:password_hash, :email, :nom, :prenom, :role)");
//     $query->execute(array(
//         "password_hash" => $motDePasseHache,
//         "email" => $email,
//         "nom" => "Parrot",
//         "prenom" => "Vincent",
//         "role" => "administrateur"
//     ));
// }

// FONCTION D'INSERTION D'UN UTILISATEUR
function addUser(PDO $pdo, string $firstName, string $lastName, string $email, string $password)
{

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    // VERIFIER SI L'UTILISATEUR EXISTE DEJA
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $existUser = $query->fetch();
    // SI L'UTILISATEUR EXISTE DEJA RETOURNE FALSE
    if ($existUser) {
        return false;
    }
    $sql = 'INSERT INTO `users` (`id`, `password_hash`, `email`, `nom`, `prenom`, `role`) VALUES (NULL, :password_hash, :email, :nom, :prenom, :role)';
    $query = $pdo->prepare($sql);

    $role = 'employe';
    $query->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':nom', $firstName, PDO::PARAM_STR);
    $query->bindParam(':prenom', $lastName, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

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
        $requete = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->execute();

        $user = $requete->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // MAJ DE LA DATE DE DERNIERE CONNEXION
            $updateQuery = $pdo->prepare("UPDATE users SET last_connexion = :last_connexion WHERE id = :id");
            $updateQuery->bindParam(':last_connexion', date('Y-m-d H:i:s'));
            $updateQuery->bindParam(':id', $user['id'], PDO::PARAM_INT);
            $updateQuery->execute();

            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['role'] = $user['role'];
            $_SESSION['user']['nom'] = $user['nom']; // Ajoutez le nom de l'utilisateur ici
            $_SESSION['user']['prenom'] = $user['prenom'];
            return true;
        } else {
            return false;
        }
    }

    return false;
}

function getUserByEmail(PDO $pdo, string $email)
{
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
}
// function getUserById(PDO $pdo, int $id)
// {
//     $query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
//     $query->bindParam(':id', $id, PDO::PARAM_INT);
//     $query->execute();

//     return $query->fetch(PDO::FETCH_ASSOC);
// }
