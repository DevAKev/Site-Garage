<?php
require_once("lib/session.php");
require_once("lib/config.php");
require_once("lib/pdo.php");


//Prévient les attaques de fixation de session
session_regenerate_id(true);
//Supprime les données de session du serveur
session_destroy();
//Supprime les données du tableau $_SESSION
unset($_SESSION);
header('location: connexion.php');
exit();
