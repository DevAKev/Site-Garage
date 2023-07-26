<div class="container mt-4">
    <h2>Avis des utilisateurs :</h2>
    <div class="row">
        <?php foreach ($avis as $review) : ?>
            <div class="col-md-4 mb-4">
                <div class="card card-animate-center">
                    <div class="card-body">
                        <h5 class="card-title">Avis de : <?php echo $review['name']; ?></h5>
                        <p class="card-text"><?php echo $review['commentaire']; ?></p>
                        <p class="card-text">Note : <?php echo $review['note'] . '/5'; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-md-4 mb-4">
    <div class="card card-animate-right">
        <div class="card-body">
            <h5 class="card-title">Ajouter un avis</h5>
            <!-- Utilisation d'un lien pour afficher la page d'ajout d'avis -->
            <a href="add_reviews.php" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>
            </a>
        </div>
    </div>
</div>
</div>
</div>