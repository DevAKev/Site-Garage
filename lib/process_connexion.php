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
            // Connexion réussie, enregistrement des informations de l'utilisateur dans la session
            $user = getUserByEmail($pdo, $email); // Ajoutez l'appel ici
            if ($user) {
                session_regenerate_id(true);
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['role'] = $user['role'];
                $_SESSION['user']['nom'] = $user['nom'];
                $_SESSION['user']['prenom'] = $user['prenom'];
                // Vous pouvez ajouter d'autres informations que vous souhaitez conserver en mémoire

                if ($user['role'] === 'administrateur') {
                    header('location: admin/index.php');
                } elseif ($user['role'] === 'employe') {
                    header('location: admin/index.php');
                } else {
                    // Redirection vers une page appropriée pour un utilisateur sans rôle spécifié
                    header('location: index.php');
                }
                exit();
            } else {
                // Erreur lors de la récupération des informations de l'utilisateur
                $errors[] = "Erreur lors de la connexion. Veuillez réessayer.";
            }
        } else {
            $errors[] = "Identifiant ou mot de passe incorrect !";
        }
    }
}
