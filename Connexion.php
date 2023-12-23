<?php
require_once('lib/session.php');
require_once('lib/config.php');
require_once('lib/pdo.php');
require_once('lib/user_tools.php');

$errors = [];
$messages = [];

// PROCESS CONNEXION
require_once('lib/process_connexion.php');
// PROCESS DECONNEXION END
?>

<div class="container">
    <div class="row">
        <div class="col-12 p-0">
            <div id="background-image" class="container-fluid">
                <?php require_once('templates/header.php'); ?>
                <!-- LOGIN FORM -->
                <?php require_once __DIR__ . ('/templates/connexion_form.php'); ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . ('/templates/footer.php');
?>