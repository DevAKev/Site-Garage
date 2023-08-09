<header>
    <?php require_once __DIR__ . ('/modal_deconnexion.php'); ?>
    <nav class="navbar navbar-expand-md navbar-secondary fixed-top">
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
                <ul class="navbar-nav ml-auto nav nav-pills">
                    <?php foreach ($mainMenu as $key => $menuItem) {
                        if (!array_key_exists("exclude", $menuItem)) { ?>
                            <li class="nav-item">
                                <a href="<?= $key; ?>" class="nav-link <?php if ($key === $currentPage) {
                                                                            echo 'active';
                                                                        } ?>"><?= $menuItem["menu_title"]; ?></a>
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

                <ul class="navbar-nav ml-auto">
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
                            <a class="nav-link" href="connexion.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                </svg></a>
                        </li>
                </ul>
            <?php } ?>

            </div>
        </div>
    </nav>
</header>