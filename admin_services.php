<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/../lib/session.php";
adminOnly();
require_once('lib/pdo.php');
require_once('lib/service_tools.php');
require_once('admin/templates/header.php');


$service = [
    'titre' => '',
    'description' => '',
    'image' => '',
];
// Traitement du formulaire de modification s'il est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
    $errors = array();

    // Vérifier que tous les champs ont été remplis
    if (empty($_POST['id']) || empty($_POST['titre']) || empty($_POST['description'])) {
        $errors[] = "Tous les champs sont obligatoires.";
    }

    // Vérifier que l'ID est un entier valide
    if (!filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
        $errors[] = "ID de service invalide.";
    }

    // Nettoyer et valider les données du formulaire
    $id = intval($_POST['id']);
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);

    // Vérifier que le service existe dans la base de données
    $service = getServiceById($pdo, $id);
    if (!$service) {
        $errors[] = "Service introuvable.";
    }

    // S'il n'y a pas d'erreurs, modifier le service dans la base de données
    if (empty($errors)) {

        $service = [
            'id' => $id,
            'titre' => $titre,
            'description' => $description,
            'image' => $image,
        ];
        if (updateService($pdo)) {
            echo "Le service a été modifié avec succès !";
        } else {
            echo "Erreur lors de la modification du service.";
        }
    } else {
        echo implode('<br>', $errors);
    }
}

// Traitement du formulaire de suppression s'il est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer"])) {
    if (!empty($_POST['id'])) {
        $id = intval($_POST['id']);
        $service = getServiceById($pdo, $id);
        if ($service) {
            deleteService($pdo, $id);
            echo "Le service a été supprimé avec succès !";
        } else {
            echo "Service introuvable.";
        }
    } else {
        echo "ID de service invalide.";
    }
}

// Récupérer les services depuis la base de données pour les afficher dans le formulaire de modification
$services = getServices($pdo);
?>

<body>
    <h1>Administration des services</h1>

    <!-- Formulaire de modification de service -->
    <h2>Modifier un service</h2>
    <form method="post" action="admin_services.php">
        <label for="id">Sélectionnez un service :</label>
        <select name="id" required>
            <?php foreach ($services as $service) { ?>
                <option value="<?= $service['id']; ?>"><?= htmlspecialchars($service['titre']); ?></option>
            <?php } ?>
        </select><br>
        <?php
        // Si un service est sélectionné, afficher ses données dans les champs de modification
        if (isset($_POST["id"]) && isset($service)) {
            $selected_id = $_POST["id"];
            if ($selected_id == $service['id']) {
                $titre_exist = $service["titre"];
                $description_exist = $service["description"];
                $image_exist = $service["image"];
            }
        }
        ?>

        <label for="titre">Nouveau titre :</label>
        <input type="text" name="titre" value="<?php echo isset($titre_exist) ? htmlspecialchars($titre_exist) : ''; ?>" required><br>
        <label for="description">Nouvelle description :</label>
        <textarea name="description" required><?php echo isset($description_exist) ? htmlspecialchars($description_exist) : ''; ?></textarea><br>
        <label for="lien_page">Nouveau lien de la page :</label>
        <input type="text" name="lien_page" value="<?php echo isset($lien_page_exist) ? htmlspecialchars($lien_page_exist) : ''; ?>" required><br>
        <br>
        <input type="submit" name="modifier" value="Modifier le service">
    </form>




    <!-- Formulaire de suppression de service -->
    <h2>Supprimer un service</h2>
    <form method="post" action="admin_services.php">
        <label for="id">Sélectionnez un service :</label>
        <select name="id" required>
            <?php foreach ($services as $service) { ?>
                <option value="<?= $service['id']; ?>"><?= htmlspecialchars($service['titre']); ?></option>
            <?php } ?>
        </select><br>
        <input type="submit" name="supprimer" value="Supprimer le service">
    </form>
    <?php require_once('admin/templates/footer.php'); ?>
</body>

</html>