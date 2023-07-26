<?php
require_once('lib/pdo.php');

if (isset($_GET['error']) && $_GET['error'] === '1') {
    // Afficher un message d'erreur
    echo '<div class="alert alert-danger" role="alert">Une erreur s\'est produite lors de la mise à jour de l\'utilisateur.</div>';
}

?>

<body>
    <h1>Avis publiés et en attente de modération :</h1>
    <form id="managementComments" action="" method="post">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Note</th>
                    <th scope="col" class="text-center">Publier</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Afficher les avis dans le tableau
                foreach ($avis as $avis) : ?>
                    <tr>
                        <td><?= $avis['id'] ?></td>
                        <td><?= $avis['name'] ?></td>
                        <td><?= $avis['commentaire'] ?></td>
                        <td><?= $avis['note'] ?></td>
                        <td class="text-center">

                            <input type="checkbox" name="published" <?= $avis['published'] == 1 ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <a href="moderate_reviews.php?id=<?= $avis['id'] ?>" class="btn btn-primary">Modifier</a>
                            <a href="delete_reviews.php?id=<?= $avis['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AdminOpinionModal">Créer un avis</button>
    </form>
    <?php require_once('templates/footer.php'); ?>