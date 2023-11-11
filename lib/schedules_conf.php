<?php

// **** MANAGING SCHEDULES **** //
// FORM SUBMISSION MANAGEMENT
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // FETCH EDIT SCHEDULES FORM
        $newSchedules = $_POST['heure_ouverture'];
        // UPDATE SCHEDULES IN DATABASE
        foreach ($newSchedules as $jour_semaine => $horairesParJour) {
            foreach ($horairesParJour as $id => $heures) {
                // CHECK IF KEYS EXIST BEFORE USING THEM
                $heure_ouverture = isset($heures['heure_ouverture']) ? $heures['heure_ouverture'] : '';
                $heure_fermeture = isset($heures['heure_fermeture']) ? $heures['heure_fermeture'] : '';
                // PROCESS UPDATE
                updateSchedule($pdo, $id, $jour_semaine, $heure_ouverture, $heure_fermeture);
            }
        }
        // GO TO THE ADMIN SCHEDULES WITH SUCCESS MESSAGE
        $currentPath = dirname($_SERVER['PHP_SELF']);
        $parentPath = dirname($currentPath);
        $redirectURL = $parentPath . '/templates/admin_schedules.php?success=1';
        echo "<script>window.location.replace('$redirectURL');</script>";
        exit();
    } catch (PDOException $e) {
        // ERROR MESSAGE REDIRECT TO THE ADMIN SCHEDULES
        $currentPath = dirname($_SERVER['PHP_SELF']);
        $parentPath = dirname($currentPath);
        $redirectURL = $parentPath . '/templates/admin_schedules.php?error=1';
        echo "<script>window.location.replace('$redirectURL');</script>";
        exit();
    }
}
