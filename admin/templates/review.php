<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/header.php";
require_once __DIR__ . "/../../lib/reviews_tools.php";

$errors = [];
$messages = [];

$review = [
    'name' => '',
    'commentaire' => '',
    'note' => '',
    'published' => ''
];

$action = 'add';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $reviewId = intval($_GET['id']);
    $reviewData = getReviewById($pdo, $reviewId);

    if ($reviewData) {
        $review = [
            'name' => $reviewData['name'],
            'commentaire' => $reviewData['commentaire'],
            'note' => $reviewData['note'],
            'published' => $reviewData['publish']
        ];
        $action = 'modify';
    } else {
        $errors[] = "Cet avis n'existe pas.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // VALIDATION DES DONNEES
    $name = trim($_POST['name']);
    $commentaire = trim($_POST['commentaire']);
    $note = intval($_POST['note']);
    $published = isset($_POST['publish']) ? 1 : 0;

    if (empty($name)) {
        $errors[] = "Le nom est obligatoire !";
    }

    if (empty($commentaire)) {
        $errors[] = "Le commentaire est obligatoire !";
    }

    if (empty($_POST['note'])) {
        $errors[] = "La note est obligatoire !";
    } elseif (!filter_var($_POST['note'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5]])) {
        $errors[] = "La note doit être un entier entre 1 et 5 !";
    }

    if (empty($errors)) {
        if ($action === 'add') {
            $res = insertReview($pdo, $name, $commentaire, $note, $published);
            if ($res) {
                $messages[] = "Avis ajouté avec succès !";
                $review = [
                    'name' => '',
                    'commentaire' => '',
                    'note' => '',
                    'published' => ''
                ];
            } else {
                $errors[] = "Une erreur est survenue lors de l'ajout de l'avis.";
            }
        } elseif ($action === 'modify' && isset($_GET['id'])) {
            $reviewId = $_GET['id'];
            $result = updateReview($pdo, $reviewId, $name, $commentaire, $note, $published);
            if ($result) {
                $messages[] = "Avis modifié avec succès !";
            } else {
                $errors[] = "Une erreur est survenue lors de la mise à jour de l'avis.";
            }
        }
    }
}

$pagetitre = $action === 'modify' ? "Modifier un avis :" : "Ajouter un avis :";
?>

<h1 class="display-5 fw-bold text-body-emphasis"><?= $pagetitre; ?></h1>

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

<div class="container p-4 m-4">
    <?php require_once __DIR__ . "/admin_formReview.php"; ?>
</div>

<a href="reviews.php" class="btn btn-secondary">Retourner à la liste des avis</a>
<?php
require_once __DIR__ . ('/footer.php');
?>