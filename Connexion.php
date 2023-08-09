<?php
require_once("lib/session.php");
require_once("lib/config.php");
require_once("lib/pdo.php");
require_once("templates/header.php");
require_once("lib/user.php");
require_once("lib/process_connexion.php");

$errors = [];
$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = login($email, $password, $pdo);
    if ($user) {
        session_regenerate_id(true);
        $_SESSION['user'] = $user;
        if ($user['role'] === 'administrateur' || $user['role'] === 'employe') {
            header('location: admin/index.php');
        } else {
            header('location: connexion.php?error=access');
            exit();
        }
    } else {
        $errors[] = ("Email ou mot de passe incorrect !");
    }
}
?>

<div id="background-image" class="container">
    <br>
    <!-- LOGIN FORM -->
    <?php require_once __DIR__ . ('/templates/connexion_form.php'); ?>

    <?php
    require_once __DIR__ . ('/templates/footer.php');
    ?>