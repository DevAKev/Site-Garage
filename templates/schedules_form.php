<?php
require_once('./lib/pdo.php');
require_once('lib/car_tools.php');
require_once('lib/schedules_conf.php');
$schedules = getSchedules($pdo);
?>

<form id="schedulesForm" action="" method="post">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Heure d'ouverture</th>
                <th>Heure de fermeture</th>
                <th>Heure d'ouverture</th>
                <th>Heure de fermeture</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schedules as $jour_semaine => $heure_ouvertures) { ?>
                <tr>
                    <td data-day="<?= $jour_semaine ?>"><?= $jour_semaine ?></td>
                    <?php foreach ($heure_ouvertures as $key => $heure_ouverture) { ?>
                        <td>
                            <input type="text" name="heure_ouverture[<?= $jour_semaine ?>][<?= $key ?>]" value="<?= $heure_ouverture['heure_ouverture'] ?>">
                            <span class="error-message heure-ouverture-error-message"></span>
                        </td>
                        <td>
                            <input type="text" name="heure_fermeture[<?= $jour_semaine ?>][<?= $key ?>]" value="<?= $heure_ouverture['heure_fermeture'] ?>">
                            <span class="error-message heure-fermeture-error-message"></span>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>