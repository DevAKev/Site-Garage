<?php
require_once __DIR__ . '/../lib/config.php';
require_once('lib/process_connexion.php');
require_once('lib/pdo.php');
require_once('lib/car_tools.php');
require_once __DIR__ . '/../lib/nav_menu.php';

$currentPage = htmlspecialchars(basename($_SERVER['SCRIPT_NAME']), ENT_QUOTES, 'UTF-8');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Referencement description-->
    <title><?= htmlspecialchars($mainMenu[$currentPage]["head_title"], ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($mainMenu[$currentPage]["meta_description"], ENT_QUOTES, 'UTF-8') ?>">
    <link rel="canonical" href="https://garageparrot.les-amis-de-la-montagne.go.yj.fr/">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Garage Vincent Parrot, votre spécialiste de la réparation 
    automobile à Toulouse (31)">
    <meta property="og:description" content="Bienvenue sur le site du Garage V.Parrot, Réparateur 
    Agrée Toutes marques&nbsp;Depuis 2021, le Garage V.Parrot vous accueille dans son atelier avec 
    grand&nbsp;plaisir. Historiquement situé à Toulouse depuis 2021, Vincent Parrot et son 
    équipe&nbsp;vous accompagne dans l'entretien, la réparation et la revente de vos 
    véhicules.">
    <link rel="icon" type="image/svg+xml" href="assets/images/garage_FILL1_wght700_GRAD0_opsz48.png">

    <!-- jQUERY LIBRARY -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="/assets/JS/jquery-ui.js"></script>
    <link rel="stylesheet" href="assets/css/jquery-ui.css">

    <!-- jQUERY TOUCH -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css" integrity="sha512-SZgE3m1he0aEF3tIxxnz/3mXu/u/wlMNxQSnE0Cni9j/O8Gs+TjM9tm1NX34nRQ7GiLwUEzwuE3Wv2FLz2667w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.js" integrity="sha512-tCkLWlSXiiMsUaDl5+8bqwpGXXh0zZsgzX6pB9IQCZH+8iwXRYfcCpdxl/owoM6U4ap7QZDW4kw7djQUiQ4G2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- NE PAS METTRE AVEC BUNDLE -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <link rel="stylesheet" href="assets/css/Eval-garage.css">

    <!-- JS -->
    <script src="assets/JS/script_backToTop.js"></script>
    <!-- <script src="assets/JS/filter_cars.js"></script> -->
</head>

<body class="container-fluid">
    <!--Bandeau CAROUSEL au dessus de la Nav-->
    <div class="container">
        <div class="row">
            <div class="col-12 p-0">
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <p class="text-center text-white mb-0 ">En cas de sinistre, vous êtes
                                libre de choisir votre réparateur !</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <?php require_once('templates/nav_header.php'); ?>

    <main class="container">