<?php
require_once __DIR__ . ('/../../lib/config.php');
require_once __DIR__ . ('/../../lib/pdo.php');
require_once __DIR__ . ('/../../lib/user.php');
require_once __DIR__ . ('/../../lib/car_tools.php');

// if (isset($_SESSION['user']) && $_SESSION['user'] !== null) {
//     $user = $_SESSION['user'];

//     if ($user['role'] === 'administrateur') {
//         $adminMenu = [
//             'index.php' => 'Accueil',
//             'admin_services.php' => 'Gérer les services',
//             'ajouter_modifier_annonces.php' => 'Gérer les annonces',
//             'admin_reviews.php' => 'Gérer les avis',
//             'admin_messages.php' => 'Messagerie',
//             'admin_schedules.php' => 'Gérer les horaires',
//             'inscription.php' => 'Gérer les utilisateurs',
//         ];
//     } elseif ($user['role'] === 'employe') {
//         $adminMenu = [
//             'index.php' => 'Accueil',
//             'ajouter_modifier_annonces.php' => 'Gérer les annonces',
//             'admin_reviews.php' => 'Gérer les avis',
//             'admin_messages.php' => 'Messagerie',
//         ];
//     } else {
//         header('Location: /connexion.php');
//         exit;
//     }

$currentpage = basename($_SERVER['SCRIPT_NAME']);
?>
<!-- HEADER START -->
<?php require_once __DIR__ . ('/head.php'); ?>

<body>

    <?php require_once __DIR__ . ('/forall_panel.php'); ?>
    <?php require_once __DIR__ . ('/admin_panel.php'); ?>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?= isset($_SESSION["user"]["prenom"]) ? $_SESSION["user"]["prenom"] . ' ' . $_SESSION["user"]["nom"] : ''; ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="/logout.php">DECONNEXION</a></li>
        </ul>
    </div>
    </div>
    <!-- HEADER END -->

    <!-- MAIN START -->
    <main class="d-flex flex-column px-4">