<?php
// FETCH SCHEDULES FROM DATABASE
function getSchedules($pdo)
{
    try {
        $query = $pdo->prepare('SELECT * FROM schedules');
        $query->execute();
        $heure_ouverture = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $jour_semaine = $row['jour_semaine'];
            unset($row['jour_semaine']);
            if (!isset($heure_ouverture[$jour_semaine])) {
                $heure_ouverture[$jour_semaine] = array();
            }
            $heure_ouverture[$jour_semaine][] = $row;
        }
        return $heure_ouverture;
    } catch (PDOException $e) {
        error_log('Error fetching schedules: ' . $e->getMessage());
        return false;
    }
}

// DELETE SCHEDULES FROM DATABASE
function deleteSchedule(PDO $pdo, int $id)
{
    try {
        $query = $pdo->prepare('DELETE FROM schedules WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    } catch (PDOException $e) {
        error_log('Error deleting schedule: ' . $e->getMessage());
        return false;
    }
}

// UPDATE SCHEDULES FROM DATABASE
function updateSchedule(PDO $pdo, int $id, string $jour_semaine, string $heure_ouverture, string $heure_fermeture)
{
    try {
        $query = $pdo->prepare('UPDATE schedules SET heure_ouverture = :heure_ouverture, heure_fermeture = :heure_fermeture WHERE id = :id AND jour_semaine = :jour_semaine');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':jour_semaine', $jour_semaine, PDO::PARAM_STR);
        $query->bindParam(':heure_ouverture', $heure_ouverture, PDO::PARAM_STR);
        $query->bindParam(':heure_fermeture', $heure_fermeture, PDO::PARAM_STR);
        return $query->execute();
    } catch (PDOException $e) {
        error_log('Error updating schedule: ' . $e->getMessage());
        return false;
    }
}
