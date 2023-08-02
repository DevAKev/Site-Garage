<?php
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => 'garageparrot.localhost',
    'httponly' => true
]);

session_start();

function adminOnly()
{
    if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] != 'administrateur' && $_SESSION['user']['role'] != 'employe')) {
        // REDIRECTION VERS LA PAGE DE CONNEXION SI L'UTILISATEUR N'EST PAS CONNECTÉ
        header("Location: /connexion.php");
        exit();
    }
}

// VERIFIE SI L'UTILISATEUR EST CONNECTÉ ET SI IL A LE ROLE ADMINISTRATEUR OU EMPLOYE
function isUserLoggedIn()
{
    return isset($_SESSION['user']['role']) && ($_SESSION['user']['role'] === 'administrateur' || $_SESSION['user']['role'] === 'employe');
}

// ACCES ADMINISTRATEUR UNIQUEMENT
function adminAccesOnly()
{
    return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'administrateur';
}
