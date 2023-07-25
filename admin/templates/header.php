<?php
require_once __DIR__ . ('/../../lib/session.php');
require_once __DIR__ . ('/../../lib/config.php');
require_once __DIR__ . ('/../../lib/pdo.php');
require_once __DIR__ . ('/../../lib/user.php');
require_once __DIR__ . ('/../../lib/car_tools.php');


// $adminMenu = [
//     'index.php' => 'Accueil',
//     '#' => 'Gérer les services',
//     'ajouter_modifier_annonces.php' => 'Gérer les annonces',
//     '#' => 'Gérer les avis',
//     '#' => 'Messagerie',
//     'admin_schedules.php' => 'Gérer les horaires',
//     'inscription.php' => 'Gérer les utilisateurs',
// ];

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
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="/connexion.php">DECONNEXION</a></li>
        </ul>
    </div>
    </div>
    <!-- HEADER END -->

    <!-- MAIN START -->
    <main class="d-flex flex-column px-4">