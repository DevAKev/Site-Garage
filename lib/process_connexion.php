<?php
require_once('lib/config.php');
require_once('lib/pdo.php');
require_once('lib/user_tools.php');
// PROCESS CONNEXION
$errors = [];
$message = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // VALUE ARE ESCAPED TO PREVENT XSS ATTACKS
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
        // VALIDATE FORM FIELDS
        if (empty($email)) {
            $errors[] = "L'adresse email est obligatoire !";
        }
        if (empty($password)) {
            $errors[] = "Le mot de passe est obligatoire !";
        }
        // IF NO ERRORS, TRY TO LOGIN
        if (count($errors) === 0) {
            if (login($email, $password, $pdo)) {
                // LOGIN SUCCESSFUL, SAVE USER DATA IN SESSION
                $user = getUserByEmail($pdo, $email);
                if ($user) {
                    session_regenerate_id(true);
                    $_SESSION['user']['id'] = $user['id'];
                    $_SESSION['user']['role'] = $user['role'];
                    $_SESSION['user']['nom'] = $user['nom'];
                    $_SESSION['user']['prenom'] = $user['prenom'];
                    // CONDITIONAL REDIRECTION
                    if ($user['role'] === 'administrateur') {
                        header('location: admin/index.php');
                    } elseif ($user['role'] === 'employe') {
                        header('location: admin/index.php');
                    } else {
                        // REDIRECTION
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
}
// PROCESS DECONNEXION END