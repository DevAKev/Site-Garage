<?php require_once __DIR__ . ('/modal_deconnexion.php'); ?>
<header class="sticky-header">
    <div class="row">
        <div class="col-12 p-0">
            <div id="gas-station" class="container">

                <nav class="navbar navbar-expand-md navbar-secondary">
                    <div class="container-fluid">
                        <a class="Logo-link" href="index.php">
                            <img id="Logo-nav" title="Site du garage V.Parrot" src="assets/images/Logo Garage V.PARROT-3.png" alt="Logo Garage" height="100px" width="180px" class="d-inline-block align-text-center p-6 ">
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse bg-secondary rounded-3 p-2" id="navbarNav">
                            <ul class="navbar-nav nav nav-pills">
                                <?php foreach ($mainMenu as $key => $menuItem) {
                                    if (!array_key_exists("exclude", $menuItem)) { ?>
                                        <li class="nav-item">
                                            <a href="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>" class="nav-link <?php if ($key === $currentPage) {
                                                                                                                                echo 'active';
                                                                                                                            } ?>"><?= htmlspecialchars($menuItem["menu_title"], ENT_QUOTES, 'UTF-8'); ?></a>
                                        </li>
                                <?php }
                                }
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
                                    <ul class="dropdown-menu dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a href="Prestations-reparations-mecaniques.php" class="dropdown-item <?php if ($currentPage === 'Prestations-reparations-mecaniques.php') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                                Mécanique & Entretien</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a href="Prestations-reparation-carrosserie-peinture.php" class="dropdown-item <?php if ($currentPage === 'Prestations-reparation-carrosserie-peinture.php') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                                Carrosserie & Peinture</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="navbar-nav ms-auto">
                                <?php if (isset($_SESSION['user'])) { ?>
                                    <li class="nav-item">
                                        <a href="#" class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#confirmModal">Déconnexion</a>
                                    </li>
                                    <?php if ($_SESSION['user']['role'] === 'administrateur' || $_SESSION['user']['role'] === 'employe') { ?>
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-outline-light me-2" href="admin/index.php">Espace Admin</a>
                                        </li>
                                    <?php } ?>
                                <?php } else { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="connexion.php">Administrateur
                                            <i class="fa-solid fa-lock p-2"></i></a>
                                    </li>
                            </ul>
                        <?php } ?>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>