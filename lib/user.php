<?php

// FONCTION D'INSERTION D'UN UTILISATEUR
function addUser(PDO $pdo, string $firstName, string $lastName, string $email, string $password)
{
    $sql = 'INSERT INTO `employés` (`id`,`nom`, `prenom`, `email`, `role`, `password`) VALUES (NULL, :nom, :prenom, :email, :role, :password)';
    $query = $pdo->prepare($sql);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $role = 'subscriber';
    $query->bindParam(':nom', $firstName, PDO::PARAM_STR);
    $query->bindParam(':prenom', $lastName, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);

    return $query->execute();
}

// FONCTION DE VERIFICATION EMAIL ET PASSWORD
function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
    $query = $pdo->prepare("SELECT * FROM employés WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}
