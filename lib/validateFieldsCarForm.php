<?php
// VERIFIER LA MARQUE
if (empty($marque)) {
    $errors[] = "La marque est obligatoire !";
} elseif (strlen($marque) > 50) {
    $errors[] = "La marque ne doit pas dépasser 50 caractères.";
} elseif (strlen($marque) < 3) {
    $errors[] = "La marque doit contenir au moins 3 caractères.";
} elseif (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ\s\-]+$/", $marque)) {
    $errors[] = "La marque ne peut contenir que des lettres, des espaces, des tirets et des caractères accentués.";
} elseif (preg_match("/[-]{2,}|[ ]{2,}|^[ -]|[ -]$/", $marque)) {
    $errors[] = "La marque ne peut pas contenir plus de 2 tirets ou espaces consécutifs, commencer ou finir par un tiret ou un espace.";
} elseif (preg_match("/[0-9!@#$%^&*(),.?\":{}|<>]/", $marque)) {
    $errors[] = "La marque ne peut pas contenir de chiffres ou de caractères spéciaux.";
}

// VERIFIER LE MODELE
if (empty($modele)) {
    $errors[] = "Le modèle est obligatoire !";
} elseif (strlen($modele) > 50) {
    $errors[] = "Le modèle ne doit pas dépasser 50 caractères.";
} elseif (strlen($modele) < 2) {
    $errors[] = "Le modèle doit contenir au moins 2 caractères.";
} elseif (preg_match("/[-]{2,}|[ ]{2,}|^[ -]|[ -]$/", $modele)) {
    $errors[] = "Le modèle ne peut pas contenir plus de 2 tirets ou espaces consécutifs, commencer ou finir par un tiret ou un espace.";
} elseif (!preg_match("/^[A-Za-z0-9\s\-]{2,50}$/", $modele)) {
    $errors[] = "Le modèle ne peut contenir que des lettres, des chiffres, des espaces et des tirets.";
}

// VERIFIER LE PRIX
if (filter_var($prix, FILTER_VALIDATE_FLOAT) === false || $prix <= 0) {
    $errors[] = "Veuillez entrer un prix valide.";
} elseif ($prix > 500000) {
    $errors[] = "Le prix ne doit pas dépasser 500 000 €.";
} elseif ($prix != intval($prix)) {
    $errors[] = "Le prix ne peut pas contenir de décimales.";
}

// VERIFIER ANNEE DE MISE EN CIRCULATION
define('ANNEE_MIN', 1900);
define('ANNEE_MAX', date('Y'));
if ($annee_mise_en_circulation < ANNEE_MIN || $annee_mise_en_circulation > ANNEE_MAX) {
    $errors[] = 'Veuillez entrer une année de mise en circulation valide (entre ' . ANNEE_MIN . ' et ' . ANNEE_MAX . ').';
}

// VERIFIER LE KILOMETRAGE
if (!filter_var($kilometrage, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)))) {
    $errors[] = 'Veuillez entrer un kilométrage valide.';
} elseif ($kilometrage > 500000) {
    $errors[] = 'Le kilométrage ne doit pas dépasser 500 000 km.';
}

// VERIFIER LES CARACTERISTIQUES
$maxCaracteristiquesLength = 500;
if (empty($caracteristiques)) {
    $errors[] = "Les caractéristiques sont obligatoires !";
    // LONGUEUR MAX DU TEXTE
} elseif (strlen($caracteristiques) > $maxCaracteristiquesLength) {
    $errors[] = 'Les caractéristiques ne doivent pas dépasser ' . $maxCaracteristiquesLength . ' caractères.';
}

// VERIFIER LES OPTIONS
$maxEquipementsOptionsLength = 500;
if (strlen($equipements_options) > $maxEquipementsOptionsLength) {
    $errors[] = 'Les équipements/options ne doivent pas dépasser ' . $maxEquipementsOptionsLength . ' caractères.';
}
