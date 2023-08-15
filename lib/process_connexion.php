<?php
require_once("lib/config.php");
require_once("lib/pdo.php");
require_once("lib/user_tools.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (login($email, $password, $pdo)) {
            // CONNEXION REUSSIE, ENREGISTREMENT DES DONNEES DANS LA SESSION
            $user = getUserByEmail($pdo, $email);
            if ($user) {
                session_regenerate_id(true);
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['role'] = $user['role'];
                $_SESSION['user']['nom'] = $user['nom'];
                $_SESSION['user']['prenom'] = $user['prenom'];

                if ($user['role'] === 'administrateur') {
                    header('location: admin/index.php');
                } elseif ($user['role'] === 'employe') {
                    header('location: admin/index.php');
                } else {
                    // REDIRECTION VERS LA PAGE D'ACCUEIL
                    header('location: index.php');
                }
                exit();
            } else {
                $errors[] = "Erreur lors de la connexion. Veuillez réessayer.";
            }
        } else {
            $errors[] = "Identifiant ou mot de passe incorrect !";
        }
    }
}
