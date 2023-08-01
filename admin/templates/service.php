<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/../../lib/service_tools.php";
require_once __DIR__ . "/../../lib/car_tools.php";
require_once __DIR__ . "/header.php";

$errors = [];
$messages = [];
$service = [
    'titre' => '',
    'description' => '',
    'categorie_id' => ''
];

$categories = getCategories($pdo);

if (isset($_GET['id'])) {
    // RECUPERER LES DONNEES EN CAS DE MODIFICATION
    $service = getServiceById($pdo, $_GET['id']);
    if ($service === false) {
        $errors[] = "L'service n\'existe pas";
    }
    $pagetitre = "Formulaire modification service";
} else {
    $pagetitre = "Formulaire ajout service";
}

if (isset($_POST['saveService'])) {

    // ***** A FAIRE GESTION DES ERREURS (champ vide etc.) ***

    $fileName = null;
    // SI ON A ENVOYE UN FICHIER
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;

            // ON DEPLACE LE FICHIER DANS UPLOAD
            // dirname(__DIR__) permet de cibler le dossier parent car on se trouve dans admin
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__) . _ASSETS_IMG_PATH_ . $fileName)) {
                if (isset($_POST['image'])) {
                    // SUPPRIMER L'ANCIENNE IMAGE QUI SERA REMPLACEE
                    unlink(dirname(__DIR__) . _ASSETS_IMG_PATH_ . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    } else {
        // SI AUCUN FICHIER N'A ETE ENVOYE
        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                // CASE DE SUPPRESSION COCHE, ON SUPPRIME L'IMAGE
                unlink(dirname(__DIR__) . _ASSETS_IMG_PATH_ . $_POST['image']);
            } else {
                $fileName = $_POST['image'];
            }
        }
    }
    // NE PAS SUPPRIMER LES CHAMPS EN CAS D'ERREUR
    $service = [
        'titre' => $_POST['titre'],
        'description' => $_POST['description'],
        'categorie_id' => $_POST['categorie_id'],
        'image' => $fileName
    ];
    // SI IL N'Y A PAS D'ERREURS, ON ENREGISTRE LES DONNEES
    if (!$errors) {
        if (isset($_GET["id"])) {
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }
        // DONNEES PASSEES A LA FONCTION saveService
        $res = saveService($pdo, $_POST["titre"], $_POST["description"], $fileName, (int)$_POST["categorie_id"], $id);

        if ($res) {
            $messages[] = "L'service a bien été sauvegardé";
            // VIDER LES CHAMPS DU FORMULAIRE APRES ENREGISTREMENT
            if (!isset($_GET["id"])) {
                $service = [
                    'titre' => '',
                    'description' => '',
                    'categorie_id' => ''
                ];
            }
        } else {
            $errors[] = "L'service n'a pas été sauvegardé";
        }
    }
}

?>
<h1><?= $pagetitre; ?></h1>

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
<?php if ($service !== false) { ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?= $service['titre']; ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="8"><?= $service['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <select name="categorie_id" id="categorie" class="form-select">
                <?php foreach ($categories as $categorie) { ?>
                    <option value="1" <?php if (isset($service['categorie_id']) && $service['categorie_id'] == $categorie['id']) { ?>selected="selected" <?php }; ?>><?= $categorie['title'] ?></option>
                <?php } ?>
            </select>
        </div>

        <?php if (isset($_GET['id']) && isset($service['image'])) { ?>
            <p>
                <img src="<?= _ASSETS_IMG_PATH_ . $service['image'] ?>" alt="<?= $service['titre'] ?>" width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox" name="delete_image" id="delete_image">
                <input type="hidden" name="image" value="<?= $service['image']; ?>">

            </p>
        <?php } ?>
        <p>
            <input type="file" name="file" id="file">
        </p>

        <input type="submit" name="saveService" class="btn btn-primary" value="Enregistrer">

    </form>

<?php } ?>



<?php require_once __DIR__ . "/footer.php"; ?>