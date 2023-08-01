<?php
$schedules = getSchedules($pdo);
?>
<ul class="nav flex-column">
    <?php foreach ($schedules as $jour_semaine => $heure_ouvertures) {
        $ouverture = $heure_ouvertures[0]['heure_ouverture'] ? date("H:i", strtotime($heure_ouvertures[0]['heure_ouverture'])) : "";
        $fermeture = end($heure_ouvertures)['heure_fermeture'] ? date("H:i", strtotime(end($heure_ouvertures)['heure_fermeture'])) : "";
    ?>
        <?php if ($ouverture && $fermeture) : ?>
            <li class="nav-item mb-2"><?= $jour_semaine ?> : <?= $ouverture ?> - <?= $fermeture ?></li>
        <?php endif; ?>
    <?php } ?>
</ul>