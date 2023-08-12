<?php
require_once __DIR__ . "/../../lib/config.php";
require_once __DIR__ . "/../../lib/session.php";
require_once __DIR__ . "/../../lib/pdo.php";
adminOnly();
require_once __DIR__ . "/../../lib/user_tools.php";
require_once __DIR__ . "/header.php";

if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

$users = getUsers($pdo, _ADMIN_ITEM_PER_PAGE_, $page);
$totalUsers = getTotalUsers($pdo);
$totalPages = ceil($totalUsers / _ADMIN_ITEM_PER_PAGE_);
?>

<h1 class="display-5 fw-bold text-body-emphasis">Gérer les comptes</h1>
<div class="d-flex gap-2 justify-content-left py-5">
    <a class="btn btn-primary d-inline-flex align-items-left" href="user.php">Ajouter un compte employé</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <th scope="row"><?= $user["id"]; ?></th>
                <td><?= $user["prenom"]; ?></td>
                <td><?= $user["nom"]; ?></td>
                <td><?= $user["email"]; ?></td>
                <td>
                    <a href="user.php?id=<?= $user['id'] ?>">Modifier</a>
                    | <a href="user_delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?')">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- PAGINATION EN CAS DE NOMBRE DE PAGES SUPERIEUR A 1 -->
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