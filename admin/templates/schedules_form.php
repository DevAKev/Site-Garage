<?php
// FETCH SCHEDULES FROM DB
$schedules = getSchedules($pdo);
?>
<!-- SCHEDULES FORM -->
<form id="schedulesForm" method="post">
    <!-- MESSAGE FOR USERS -->
    <p> Pour modifier les horaires de fermeture du matin et d'ouverture de l'après-midi, veuillez modifier uniquement les horaires du <strong>LUNDI.</strong></p>
    <div class="table-responsive">
        <!-- SCHEDULES ARRAY -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jour</th>
                    <th>Ouverture (matin)</th>
                    <th>Fermeture (matin)</th>
                    <th>Ouverture (après-midi)</th>
                    <th>Fermeture (après-midi)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schedules as $jour_semaine => $heure_ouvertures) { ?>
                    <tr>
                        <!-- DAY OF WEEK -->
                        <td data-day="<?= $jour_semaine ?>"><?= $jour_semaine ?></td>
                        <?php foreach ($heure_ouvertures as $horaire) { ?>
                            <td>
                                <!-- FIELD FOR OPEN -->
                                <input type="time" name="heure_ouverture[<?= $jour_semaine ?>][<?= $horaire['id'] ?>][heure_ouverture]" value="<?= htmlspecialchars($horaire['heure_ouverture']) ?>">
                            </td>
                            <td>
                                <!-- FIELD FOR CLOSE -->
                                <input type="time" name="heure_ouverture[<?= $jour_semaine ?>][<?= $horaire['id'] ?>][heure_fermeture]" value="<?= htmlspecialchars($horaire['heure_fermeture']) ?>">
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- SUBMIT -->
    <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sûr(e) de vouloir modifier les horaires ?')">Enregistrer les modifications</button>
</form>
</div>
</div>