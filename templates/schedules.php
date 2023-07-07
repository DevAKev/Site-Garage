<?php
$heure_ouverture = getSchedules($pdo);
?>
<ul class="nav flex-column">
    <?php foreach ($heure_ouverture as $jour_semaine => $heure_ouverture) { ?>
        <li class="nav-item mb-2"><?= $jour_semaine ?> :
            <?php foreach ($heure_ouverture as $key => $heure_ouverture) { ?>
                <?= $heure_ouverture['heure_ouverture'] ?> - <?= $heure_ouverture['heure_fermeture'] ?>
            <?php } ?>
        </li>
    <?php } ?>
</ul>