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
        $errors[] = "Le service n'existe pas !";
    }
    $pagetitre = "Modifier un service :";
} else {
    $pagetitre = "Ajouter un service :";
}

if (isset($_POST['saveService'])) {
    // GESTION DES ERREURS

    if (empty($_POST['titre'])) {
        $errors[] = "Le titre est obligatoire !";
    }

    if (empty($_POST['description'])) {
        $errors[] = "La description est obligatoire !";
    }

    if (empty($_POST['image']) && empty($_FILES['file']['tmp_name'])) {
        $errors[] = "L'image est obligatoire !";
    }

    // VERIFIER l'IMAGE
    $fileName = '';
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = uniqid() . '_' . slugify($_FILES["file"]["name"]);
            $imagePath = dirname(__DIR__) . '/../assets/images/' . $fileName;
            move_uploaded_file($_FILES["file"]["tmp_name"], $imagePath);

            if (isset($_POST['image'])) {
                // SUPPRIMER L'ANCIENNE IMAGE QUI SERA REMPLACEE
                unlink(dirname(__DIR__) . '/../assets/images/' . $_POST['image']);
            }
        } else {
            $errors[] = 'Le fichier doit être une image !';
        }
    } else {
        // SI AUCUNE IMAGE N'A ETE UPLOADEE
        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                // CASE DE SUPPRESSION COCHE? SUPPRIMER L'IMAGE
                unlink(dirname(__DIR__) . '/../assets/images/' . $_POST['image']);
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

    // SI AUCUNE ERREUR, ON ENREGISTRE LES DONNEES
    if (!$errors) {
        if (isset($_GET["id"])) {
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }
        // DONNEES PASSEES A LA FONCTION saveService
        $res = saveService($pdo, $_POST["titre"], $_POST["description"], $fileName, (int)$_POST["categorie_id"], $id);

        if ($res) {
            $messages[] = "Le service a bien été sauvegardé !";
            // VIDER LES CHAMPS DU FORMULAIRE APRES ENREGISTREMENT
            if (!isset($_GET["id"])) {
                $service = [
                    'titre' => '',
                    'description' => '',
                    'categorie_id' => ''
                ];
            }
        } else {
            $errors[] = "Le service n'a pas été sauvegardé !";
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
    <div class="container p-4 m-4">
        <?php require_once __DIR__ . "/admin_formService.php"; ?>
    </div>
    <a href="services.php" class="btn btn-secondary">Retourner à la liste des services</a>
<?php } ?>

<?php require_once __DIR__ . "/footer.php"; ?>