<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/../../lib/contact_tools.php";
require_once __DIR__ . "/header.php";

$errors = [];
$messages = [];

// RECUPERATION DU MESSAGE DEPUIS LA BASE DE DONNEES
if (isset($_GET['id'])) {
    $messageId = (int)$_GET['id'];
    $message = getMessageById($pdo, $messageId);

    if ($message) {
        // MAJ STATUT DU MESSAGE
        if ($message['status'] === 'non lu') {
            updateMessageStatus($pdo, $messageId, 'lu');
        }

        // CONTENU DU MESSAGE
        echo "<h1 class='display-5 fw-bold text-body-emphasis'>Message de : {$message['prenom']} {$message['nom']}</h1>";
        echo "<p>Date : {$message['date']}</p>";
        echo "<p>Email : {$message['email']}</p>";
        echo "<p>Téléphone : {$message['phone_number']}</p>";
        echo "<p>Objet : {$message['objet']}</p>";
        echo "<p>Message :</p>";
        echo "<p>{$message['message']}</p>";
    } else {
        $errors[] =  "<p>Message non trouvé.</p>";
    }
} else {
    $errors[] = "<p>Aucun ID de message spécifié.</p>";
}
?>
<!-- RETOUR VERS LA PAGE GESTION DES MESSAGES -->
<a href="messages.php" class="btn btn-secondary">Retourner à la liste des messages</a>
<?php
require_once __DIR__ . "/footer.php";
?>