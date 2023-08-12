<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/header.php";
require_once __DIR__ . "/../../lib/user_tools.php";

$errors = [];
$messages = [];

$user = [
    'prenom' => '',
    'nom' => '',
    'email' => '',
];
// ACTION PAR DEFAUT(Ajouter un utilisateur)
$action = 'add';

if (isset($_GET['id'])) {
    // RECUPERER LES DONNEES EN CAS DE MODIFICATION
    $userData = getUserById($pdo, $_GET['id']);
    if ($userData === false) {
        $errors[] = "Ce compte n'existe pas !";
    } else {
        // SI UN ID EST PRESENT DANS L'URL, ON EST EN MODE MODIFICATION
        $action = 'modify';
        $user = [
            'prenom' => $userData['prenom'],
            'nom' => $userData['nom'],
            'email' => $userData['email'],
        ];
    }
}

// GESTION DES ERREURS 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['prenom'])) {
        $errors[] = "Le prénom est obligatoire !";
    } elseif (!preg_match("/^[A-Za-z\- ]+$/", $_POST['prenom'])) {
        $errors[] = "Le prénom doit contenir uniquement des lettres, des espaces et des tirets !";
    } elseif (strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
        $errors[] = "Le prénom doit contenir entre 2 et 20 caractères !";
    }

    if (empty($_POST['nom'])) {
        $errors[] = "Le nom est obligatoire !";
    } elseif (!preg_match("/^[A-Za-z\- ]+$/", $_POST['nom'])) {
        $errors[] = "Le nom doit contenir uniquement des lettres, des espaces et des tirets !";
    } elseif (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {
        $errors[] = "Le nom doit contenir entre 2 et 20 caractères !";
    }

    if (empty($_POST['email'])) {
        $errors[] = "L'email est obligatoire !";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Veuillez entrer une adresse e-mail valide !";
    }
    $userData = [
        'prenom' => $_POST['prenom'],
        'nom' => $_POST['nom'],
        'email' => $_POST['email'],
    ];

    if ($action === 'add' && !empty($_POST['add'])) {
        if (empty($_POST['password'])) {
            $errors[] = "Le mot de passe est obligatoire pour créer un compte !";
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST['password'])) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères, une lettre minuscule, une lettre majuscule et un chiffre !";
        }
    }

    // SI AUCUNE ERREUR, ON ENREGISTRE LES DONNEES
    if (empty($errors)) {
        if ($action === 'add') {
            $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $res = addUser($pdo, $userData['prenom'], $userData['nom'], $userData['email'], $_POST['password']);
            if ($res) {
                $messages[] = "Compte ajouté avec succès !";
                // VIDER LES CHAMPS DU FORMULAIRE APRES ENREGISTREMENT
                $userData = [
                    'prenom' => '',
                    'nom' => '',
                    'email' => '',
                ];
            } else {
                $errors[] = "Une erreur est survenue lors de l'ajout du compte.";
            }
        } elseif ($action === 'modify' && isset($_GET['id'])) {
            $userId = $_GET['id'];
            updateUser($pdo, $userId, $userData['prenom'], $userData['nom'], $userData['email'], "");
            $messages[] = "Compte modifié avec succès !";
        }
    }
}

$pagetitre = $action === 'modify' ? "Modifier un compte :" : "Ajouter un compte :";
?>

<h1><?= $pagetitre; ?></h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success" role="alert">
        <?= $message; ?>
    </div>
<?php } ?>
<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?>
    </div>
<?php } ?>

<?php require_once __DIR__ . "/../../templates/addUser_form.php"; ?>

<a href="users.php" class="btn btn-secondary">Retourner à la liste des comptes</a>
<?php
require_once __DIR__ . ('/footer.php');
?>