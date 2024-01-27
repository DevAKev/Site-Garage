<?php
// VERIFIER VALIDITE DU NOM
if (empty($_POST['nom'])) {
    $errors[] = "Le nom est obligatoire !";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['nom'])) {
    $errors[] = "Seules les lettres et les espaces sont autorisés !";
} else {
    // VERIFIER VALIDITE DU PRENOM
    if (empty($_POST['prenom'])) {
        $errors[] = "Le prénom est obligatoire !";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['prenom'])) {
        $errors[] = "Seules les lettres et les espaces sont autorisés !";
    } else {
        // VERIFIER VALIDITE DE L'EMAIL
        if (empty($_POST['email'])) {
            $errors[] = "L'email est obligatoire !";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse email n'est pas valide !";
        } else {
            // VERIFIER VALIDITE DU NUMERO DE TELEPHONE
            if (empty($_POST['phone_number'])) {
                $errors[] = "Le numéro de téléphone est obligatoire !";
            } elseif (!preg_match("/^(0[1-9]|6)\d{8}$/", $_POST['phone_number'])) {
                $errors[] = "Le numéro de téléphone n'est pas valide !";
            } else {
                // lONGUEUR DU NUMERO DE TELEPHONE
                $phone_number = substr($_POST['phone_number'], 0, 10);
                // VERIFIER VALIDITE DU MESSAGE
                if (empty($_POST['message'])) {
                    $errors[] = "Le message est obligatoire !";
                } else {
                    // APPELER LA FONCTION D'INSERTION D'UN MESSAGE
                    $success = insertMessage($pdo, $nom, $prenom, $email, $phone_number, $message_text, $date, $status, $objet);
                    if ($success) {
                        $messages[] = "Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.";
                    } else {
                        $errors[] = "Une erreur s'est produite lors de l'envoi du message. Veuillez réessayer.";
                    }
                }
            }
        }
    }
}
