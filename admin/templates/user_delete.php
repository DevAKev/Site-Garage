<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/header.php";
require_once __DIR__ . "/../../lib/user_tools.php";

$user = false;
$errors = [];
$messages = [];

if (isset($_GET["id"])) {
    $user = getUserById($pdo, (int)$_GET["id"]);
}

if ($user) {
    if (deleteUser($pdo, $_GET["id"])) {
        $messages[] = "Le compte a bien été supprimé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le compte n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supprimer le compte</h1>
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
</div>
<!-- RETOUR VERS LA PAGE GESTION DES UTILISATEURS -->
<a href="users.php" class="btn btn-secondary">Retourner à la liste des comptes</a>
<?php
require_once __DIR__ . ('/footer.php');
?>