<?php
require_once("lib/session.php");
require_once("lib/config.php");
require_once("lib/pdo.php");
require_once("templates/header.php");
require_once("lib/user.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = login($email, $password, $pdo);
    if ($user) {
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
        if ($user['role'] === 'administrateur') {
            header('location: admin/index.php');
        } elseif ($user['role'] === 'employe') {
            header('location: admin/index.php');
        } else {
            $errors[] = ("Vous n'avez pas les droits d'accès à cette page !");
        }
    } else {
        $errors[] = ("Email ou mot de passe incorrect !");
    }
    // if (login($email, $password, $pdo)) {
    //     header('location: admin/index.php');
    //     exit();
    // } else {
    //     $errors[] = ("Email ou mot de passe incorrect !");
    // }
}
?>

<div id="background-image" class="container">
    <br>
    <!-- LOGIN FORM -->
    <?php require_once __DIR__ . ('/templates/connexion_form.php'); ?>

    <?php
    require_once __DIR__ . ('/templates/footer.php');
    require_once __DIR__ . ('/lib/scripts.php');
    ?>