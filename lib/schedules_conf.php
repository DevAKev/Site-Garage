<?php
require_once('./lib/pdo.php');


// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupération des horaires modifiés depuis le formulaire
        $newSchedules = $_POST['heure_ouverture'];
        $newCloseSchedules = $_POST['heure_fermeture'];

        // Mise à jour des horaires dans la base de données
        foreach ($newSchedules as $jour_semaine => $heure_ouvertures) {
            foreach ($heure_ouvertures as $key => $heure_ouverture) {
                $heure_fermeture = $newCloseSchedules[$jour_semaine][$key];

                // Préparation de la requête
                $query = $pdo->prepare('UPDATE schedules SET heure_ouverture = :heure_ouverture, heure_fermeture = :heure_fermeture WHERE jour_semaine = :jour_semaine');

                // Liaison des valeurs aux paramètres de la requête
                $query->bindValue(':heure_ouverture', $heure_ouverture);
                $query->bindValue(':heure_fermeture', $heure_fermeture);
                $query->bindValue(':jour_semaine', $jour_semaine);

                // Exécution de la requête
                $query->execute();
            }
        }

        // Redirection vers la page admin_schedules.php avec un paramètre de confirmation
        $currentPath = dirname($_SERVER['PHP_SELF']);
        $parentPath = dirname($currentPath);
        $redirectURL = $parentPath . '/admin_schedules.php?success=1';
        header('Location: ' . $redirectURL);
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        // Redirection vers la page admin_schedules.php avec un paramètre d'erreur
        $currentPath = dirname($_SERVER['PHP_SELF']);
        $parentPath = dirname($currentPath);
        $redirectURL = $parentPath . '/admin_schedules.php?error=1';
        header('Location: ' . $redirectURL);
        exit();
    }
}
