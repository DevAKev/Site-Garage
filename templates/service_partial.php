<?php
require_once('lib/service_tools.php');
$services = getServices($pdo);
?>
<div class="container">
    <div class="d-flex flex-row justify-content-start align-items-center">
        <div class="card-container">
            <div class="row mt-4">
                <?php foreach ($services as $service) { ?>
                    <div class="col-md-4 mt-4 p-3">
                        <article>
                            <div class="card card-animate-<?= $service["mouvement"] ? htmlspecialchars($service["mouvement"]) : '' ?>">
                                <a href="<?= htmlspecialchars($service["lien_page"]) ?>">
                                    <img src="<?= htmlspecialchars(getServiceImage($service["image"])) ?>" class="card-img-top rounded-3" alt="<?= htmlspecialchars($service["titre"]) ?>">
                                </a>
                                <div class="card-body">
                                    <h2 class="card-title"><?= htmlspecialchars($service["titre"]) ?></h2>
                                    <p class="card-text"><?= htmlspecialchars($service["description"]) ?></p>
                                    <a href="<?= htmlspecialchars($service["lien_page"]) ?>" class="btn btn-primary">En savoir +</a>
                                    <?php if (isUserLoggedIn()) { ?>
                                        <a href="/admin/templates/services.php" class="btn btn-primary">Modifier le service</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<br>
<br>