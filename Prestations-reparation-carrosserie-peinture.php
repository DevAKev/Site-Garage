<?php
require_once('templates/header.php');
?>
<!-- Fil d'ariane -->
<nav aria-label="breadcrumb" class="mt-5 pt-5">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item">Services</li>
            <li class="breadcrumb-item active" aria-current="page">Carrosserie & Peinture</li>
        </ol>
    </div>
</nav>

<!-- Services -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="/assets/images/Carrossier.jpg" alt="Carrosserie">
                <div class="card-body">
                    <h5 class="card-title">Carrosserie</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="/assets/images/paintcar.jpg" alt="Peinture">
                <div class="card-body">
                    <h5 class="card-title">Peinture</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BUTTON BACK TO TOP -->
<div class="back-to-top-container p-4">
    <div class="back-to-top">
        <div class="btn btn-primary">
            <a href="Prestations-reparation-carrosserie-peinture.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- FOOTER START -->
<?php
require_once __DIR__ . ('/templates/footer.php');
// FOOTER END
?>