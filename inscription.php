<?php
require_once __DIR__ . ('/lib/session.php');
adminOnly();
require_once __DIR__ . ('/admin/templates/header.php');
require_once('lib/user.php');

$errors = [];
$messages = [];

if (isset($_POST['addUser'])) {
    $res = addUser($pdo, $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password']);

    if ($res) {
        $messages[] = 'Votre inscription a bien été prise en compte !';
    } else {
        $errors[] = 'Une erreur est survenue lors de l\'inscription !';
    }
}

if (isset($_POST['deleteUser'])) {
    $res = deleteUser($pdo, $_POST['user']['id']);

    if ($res) {
        $messages[] = 'L\'utilisateur a bien été supprimé !';
    } else {
        $errors[] = 'Une erreur est survenue lors de la suppression de l\'utilisateur !';
    }
}
?>
<div id="img-inscription">
    <h1> INSCRIPTION </h1>
</div>

<!-- Formulaire d'inscription-->
<?php
require_once('templates\addUser_form.php');
?>

<h1>Supprimer un utilisateur</h1>


</header>

<!-- FOOTER START -->
<?php
require_once('admin/templates/footer.php');
// FOOTER END
//  IMPORT SCRIPTS 
require_once __DIR__ . ('/lib/scripts.php');
?>
<script type="module" src="assets/JS/main.js"></script>