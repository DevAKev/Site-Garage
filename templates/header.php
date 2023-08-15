<?php
require_once __DIR__ . '/../lib/config.php';
require_once('lib/process_connexion.php');
require_once('lib/pdo.php');
require_once('lib/car_tools.php');
require_once __DIR__ . '/../lib/nav_menu.php';

$currentPage = basename($_SERVER['SCRIPT_NAME']);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Referencement description-->
    <title><?= $mainMenu[$currentPage]["head_title"] ?></title>
    <meta name="description" content="<?= $mainMenu[$currentPage]["meta_description"] ?>">
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

    <!-- jQUERY LIBRARY -->
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"></script>

    <!-- FONTAWESOME -->
    <script src="https://kit.fontawesome.com/88773cb8bb.js" crossorigin="anonymous"></script>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- FANCYBOX -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">
    <link rel="stylesheet" href="assets/css/Eval-garage.css">
</head>

<body class="container">
    <!--Bandeau CAROUSEL au dessus de la Nav-->
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <p class="text-center text-white mb-0 ">En cas de sinistre, vous êtes libre de
                    choisir votre réparateur !</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <?php require_once('templates/nav_header.php'); ?>

    <main class="container">