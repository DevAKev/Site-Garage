<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/../../lib/contact_tools.php";
require_once __DIR__ . "/header.php";

$errors = [];
$messages = [];

// TOTAL DES MESSAGES
$contacts = getMessages($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['message_id']) && isset($_POST['status'])) {
        $message_id = (int)$_POST['message_id'];
        $new_status = $_POST['status'] === 'on' ? 'lu' : 'non lu';

        $success = updateMessageStatus($pdo, $message_id, $new_status);
        if ($success) {
            $messages[] = "Le statut du message a été mis à jour avec succès.";
        } else {
            $errors[] = "Une erreur s'est produite lors de la mise à jour du statut du message. Veuillez réessayer.";
        }
    }
}
?>

<h1 class="display-5 fw-bold text-body-emphasis">Gérer la messagerie</h1>
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

<div class="refresh">
    <a class="btn btn-primary d-inline-flex align-items-left m-2" href="/admin/templates/messages.php"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
            <path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z" />
        </svg></a>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Message</th>
                        <th scope="col">Date</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Objet</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact) : ?>
                        <tr>
                            <td><?= $contact['id'] ?></td>
                            <td><?= $contact['nom'] ?></td>
                            <td><?= $contact['prenom'] ?></td>
                            <td><?= $contact['email'] ?></td>
                            <td><?= $contact['phone_number'] ?></td>
                            <td><?= $contact['message'] ?></td>
                            <td><?= $contact['date'] ?></td>
                            <td><?= $contact['status'] ?></td>
                            <td><?= $contact['objet'] ?></td>
                            <td>
                                <div class="action">
                                    <a href="message.php?id=<?= $contact['id'] ?>" class="btn btn-primary">Lire</a>
                                    <a href="repondre_message.php?id=<?= $contact['id'] ?>" class="btn btn-primary">Répondre</a>
                                    <a href="message_delete.php?id=<?= $contact['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php
        require_once __DIR__ . ("/footer.php");
        ?>