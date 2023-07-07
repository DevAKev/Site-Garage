<?php
require_once('lib/pdo.php');
require_once('lib/config.php');

$currentpage = basename($_SERVER['SCRIPT_NAME']);

?>

<!-- HEAD START -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Referencement description-->
    <title>Réparation Mécanique - Carrosserie toutes marques - Entretien, Mécanique,
        Carrosserie/Peinture, Vente de véhicules d'occasions - Garage V. Parrot
    </title>
    <meta name="description" content="Garage V.Parrot, votre spécialiste de la réparation de 
    véhicules toutes Marques à Toulouse en Haute-Garonne(31). Vente de 
    véhicules d'occasions. Entretien, réparation mécanique et carrosserie automobile.">
    <link rel="canonical" href="#">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Garage V. Parrot, votre spécialiste de la réparation 
    automobile à Toulouse (31)">
    <meta property="og:description" content="Bienvenue sur le site du Garage V.Parrot, Réparateur 
    Agrée Toutes marques&nbsp;Depuis 2021, le Garage V.Parrot vous accueille dans son atelier avec 
    grand&nbsp;plaisir. Historiquement situé à Toulouse depuis 2021, Vincent Parrot et son 
    équipe&nbsp;vous accompagne dans l'entretien, la réparation et la revente de vos 
    véhicules.">
    <link rel="icon" type="image/svg+xml" href="assets/images/garage_FILL1_wght700_GRAD0_opsz48.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/88773cb8bb.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">
    <link rel="stylesheet" href="assets/css/Eval-garage.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<!-- HEAD END -->
<!--Bandeau CAROUSEL au dessus de la Nav-->
<div id="header-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <p class="text-center text-white mb-0 ">En cas de sinistre, vous êtes libre de
                choisir votre réparateur !</p>
        </div>
    </div>
</div>

<!-- HEADER START  -->
<!-- Navigation -->
<header>
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
                    <?php foreach ($mainMenu as $key => $value) { ?>
                        <li class="nav-item">
                            <a href="<?= $key; ?>" class="nav-link <?php if ($currentpage === $key) {
                                                                        echo 'active';
                                                                    } ?>"><?= $value; ?></a>
                        </li>
                    <?php } ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
                        <ul class="dropdown-menu dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="Prestations-reparations-mecaniques.php" class="dropdown-item <?php if ($currentpage === 'Prestations-reparations-mecaniques.php') {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                                    Mécanique & Entretien</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a href="Prestations-reparation-carrosserie-peinture.php" class="dropdown-item <?php if ($currentpage === 'Prestations-reparation-carrosserie-peinture.php') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                    Carrosserie & Peinture</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Connexion.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                            </svg></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- HEADER END  -->
<main class="container">