<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/../../lib/service_tools.php";
require_once __DIR__ . "/../../lib/car_tools.php";
require_once __DIR__ . "/header.php";

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}
$services = getServices($pdo, _ADMIN_ITEM_PER_PAGE_, $page);

$totalServices = getTotalService($pdo);

$totalPages = ceil($totalServices / _ADMIN_ITEM_PER_PAGE_);

?>


<h1 class="display-5 fw-bold text-body-emphasis">Gérer les services</h1>
<div class="d-flex gap-2 justify-content-left py-5">
    <a class="btn btn-primary d-inline-flex align-items-left" href="service.php">
        Ajouter un service
    </a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($services as $service) { ?>
            <tr>
                <th scope="row"><?= $service["id"]; ?></th>
                <td><?= $service["titre"]; ?></td>
                <td><a href="service.php?id=<?= $service['id'] ?>">Modifier</a>
                    | <a href="service_delete.php?id=<?= $service['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?')">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if ($totalPages > 1) { ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item">
                    <a class="page-link <?php if ($i == $page) {
                                            echo " active";
                                        } ?>" href="?page=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</nav>


<?php
require_once __DIR__ . ('/footer.php');
?>