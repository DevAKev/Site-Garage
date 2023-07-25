<?php
$schedules = getSchedules($pdo);
?>
<ul class="nav flex-column">
    <?php foreach ($schedules as $jour_semaine => $heure_ouvertures) { ?>
        <li class="nav-item mb-2"><?= $jour_semaine ?> :
            <?php foreach ($heure_ouvertures as $key => $heure_ouverture) { ?>
                <?= $heure_ouverture['heure_ouverture'] ?> - <?= $heure_ouverture['heure_fermeture'] ?>
            <?php } ?>
        </li>
    <?php } ?>
</ul>