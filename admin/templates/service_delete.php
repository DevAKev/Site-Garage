<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/../../lib/service_tools.php";
require_once __DIR__ . "/../../lib/car_tools.php";
require_once __DIR__ . "/header.php";

$service = false;
$errors = [];
$messages = [];
if (isset($_GET["id"])) {
    $service =  getServiceById($pdo, (int)$_GET["id"]);
}
if ($service) {
    if (deleteService($pdo, $_GET["id"])) {
        $messages[] = "Le service a bien été supprimé";
    } else {
        $errors[] = "Une erreur s'est produite lors de la suppression";
    }
} else {
    $errors[] = "Le service n'existe pas";
}
?>
<div class="row text-center my-5">
    <h1>Supprimer le service</h1>
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

<?php require_once __DIR__ . "/footer.php"; ?>