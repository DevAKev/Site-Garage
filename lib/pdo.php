<!-- START CONNECT TO DATABASE -->
<?php
$pdo = new PDO('mysql:dbname=garage_parrot;host=localhost;charset=utf8mb4', 'root', '');


function getSchedules($pdo)
{
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
}
