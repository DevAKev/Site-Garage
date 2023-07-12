<?php

function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password)
{
    $sql = 'INSERT INTO `employés` (`id`,`nom`, `prenom`, `email`, `role`, `password`) VALUES (NULL, :nom, :prenom, :email, :role, :password)';
    $query = $pdo->prepare($sql);
    $role = 'subscriber';
    $query->bindParam(':nom', $first_name, PDO::PARAM_STR);
    $query->bindParam(':prenom', $last_name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);

    return $query->execute();
}
