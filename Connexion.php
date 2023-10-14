<?php
require_once("lib/session.php");
require_once("lib/config.php");
require_once("lib/pdo.php");
require_once("lib/user_tools.php");
require_once("lib/process_connexion.php");

$errors = [];
$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

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
<div class="container">
    <div class="row">
        <div class="col-12 p-0">
            <div id="background-image" class="container-fluid">
                <?php require_once("templates/header.php"); ?>
                <!-- LOGIN FORM -->
                <?php require_once __DIR__ . ('/templates/connexion_form.php'); ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . ('/templates/footer.php');
?>