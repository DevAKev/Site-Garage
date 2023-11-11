<?php
// FUNCTIONS
require_once('lib/schedules_tools.php');
$schedules = getSchedules($pdo);
// PARCOURIR LES HORAIRES POUR RECUPERER LES HORAIRES DE FERMETURE DU MATIN ET D'OUVERTURE DE L'APRES-MIDI DU PREMIER JOUR
foreach ($schedules as $jour_semaine => $heure_ouvertures) {
    // UTILISER LES HORAIRES DU PREMIER JOUR POUR DEFINIR LES VARIABLES $fermetureMatin ET $ouvertureApresMidi
    $fermetureMatin = $heure_ouvertures[0]['heure_fermeture'] ? date("H:i", strtotime($heure_ouvertures[0]['heure_fermeture'])) : "";
    $ouvertureApresMidi = $heure_ouvertures[1]['heure_ouverture'] ? date("H:i", strtotime($heure_ouvertures[1]['heure_ouverture'])) : "";
    // SORTIR DE LA BOUCLE
    break;
}
?>
<!-- AFFICHER LES HORAIRES -->
<h3>Nos horaires</h3>
<ul class="nav flex-column">
    <?php foreach ($schedules as $jour_semaine => $heure_ouvertures) {
        // RECUPERER LES HORAIRES D'OUVERTURE DU MATIN ET DE FERMETURE DU SOIR DE CHAQUE JOUR
        $ouverture = $heure_ouvertures[0]['heure_ouverture'] ? date("H:i", strtotime($heure_ouvertures[0]['heure_ouverture'])) : "";
        $fermeture = end($heure_ouvertures)['heure_fermeture'] ? date("H:i", strtotime(end($heure_ouvertures)['heure_fermeture'])) : "";
    ?>
        <!-- AFFICHER LES HORAIRES DE CHAQUE JOUR -->
        <?php if ($ouverture && $fermeture) : ?>
            <li class="nav-item mb-2"><?= $jour_semaine ?> : <?= $ouverture ?> - <?= $fermeture ?></li>
        <?php endif; ?>
    <?php } ?>
    <!-- INDIQUER LES HORAIRES DE FERMETURE DU MATIN ET D'OUVERTURE DE L'APRES-MIDI -->
    <p>Nous sommes fermés de : <?= htmlspecialchars($fermetureMatin) ?> à <?= htmlspecialchars($ouvertureApresMidi) ?> (Sauf le Samedi)</p>
</ul>