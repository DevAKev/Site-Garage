<?php
require_once("lib/config.php");
require_once("lib/pdo.php");
require_once("lib/user.php");

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (login($email, $password, $pdo)) {

            header('location: admin/templates/index.php');
            exit();
        } else {
            $errors[] = ("Identifiant ou mot de passe incorrect !");
        }
    }
}
