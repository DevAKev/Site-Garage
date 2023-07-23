<?php
require_once __DIR__ . ('/../../lib/config.php');
require_once __DIR__ . ('/../../lib/session.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Garage V. Parrot</title>
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
    <link rel="icon" type="image/svg+xml" href="/assets/images/garage_FILL1_wght700_GRAD0_opsz48.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/88773cb8bb.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="/assets/css/override-bootstrap.css">
</head>

<body>

    <!-- HEADER START -->
    <?php require_once __DIR__ . ('/forall_panel.php'); ?>
    <?php require_once __DIR__ . ('/admin_panel.php'); ?>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="./logout.php">DECONNEXION</a></li>
        </ul>
    </div>
    </div>
    <!-- HEADER END -->

    <!-- MAIN START -->
    <main class="d-flex flex-column px-4">