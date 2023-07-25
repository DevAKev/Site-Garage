import { showToast } from "./tools.js";

// START- Fonction de validation

// Validation des champs requis
function validateRequired(input) {
  return !(input.value == null || input.value == "");
}

// Validation du nombre de caractères
function validateLength(input, minLength, maxLength) {
  return !(input.value.length < minLength || input.value.length > maxLength);
}

// Validation des caractères : LATIN & LETTRES
function validateText(input) {
  return input.value.match("^[A-Za-z]+$");
}

//Validation email
function validateEmail(input) {
  let EMAIL = input.value;
  let POSAT = EMAIL.indexOf("@");
  let POSDOT = EMAIL.lastIndexOf(".");

  return !(POSAT < 1 || POSDOT - POSAT < 2);
}

// Validation du numéro de téléphone
// function validatePhoneNumber(input) {
//   return input.value.match(/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/);
// }

//Validation Code Postal
/*function validatepostCode(input){
    return input.value.match("^(0[1-9]|[1-9][0-9])[0-9][0-9][0-9]$");
}

// Validation adresse
function validateAddress(input){
    return input.value.match(/^\s*\S+(?:\s+\S+){2}/);
}

// Validation de la ville
function validateCity(input) {
    const cityValue = input.value.trim();
    const regex = /^[a-zA-Z\s-]+$/;
    return regex.test(cityValue);
}*/

//validation du mot de passe
function validatePassword(input) {
  return input.value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/);
}

//Validaton de la checkbox
function validateConditions(input) {
  return input.checked;
}

// END - Fonction de validation

//==== START Validation des champs du formulaire====//
// Fonction de validation globale du formulaire
// Fonction de validation globale du formulaire
function validateFormFields() {
  const firstNameInput = document.getElementById("firstName");
  const lastNameInput = document.getElementById("lastName");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const conditionsInput = document.getElementById("conditions");

  const firstName = firstNameInput.value.trim();
  const lastName = lastNameInput.value.trim();
  const email = emailInput.value.trim();
  const password = passwordInput.value;

  // Validation du champ PRENOM
  if (!validateRequired(firstNameInput)) {
    showToast("Veuillez entrer votre prénom !");
    firstNameInput.focus();
    return false;
  }

  if (!validateLength(firstNameInput, 2, 20)) {
    showToast("Le prénom doit contenir entre 2 et 20 caractères !");
    firstNameInput.focus();
    return false;
  }

  if (!validateText(firstNameInput)) {
    showToast("Le prénom doit contenir uniquement des lettres !");
    firstNameInput.focus();
    return false;
  }

  // Validation du champ NOM
  if (!validateRequired(lastNameInput)) {
    showToast("Veuillez entrer votre nom !");
    lastNameInput.focus();
    return false;
  }

  if (!validateLength(lastNameInput, 2, 20)) {
    showToast("Le nom doit contenir entre 2 et 20 caractères !");
    lastNameInput.focus();
    return false;
  }

  if (!validateText(lastNameInput)) {
    showToast("Le nom doit contenir uniquement des lettres !");
    lastNameInput.focus();
    return false;
  }

  // Validation du champ EMAIL
  if (!validateRequired(emailInput)) {
    showToast("Veuillez entrer votre adresse e-mail !");
    emailInput.focus();
    return false;
  }

  if (!validateEmail(emailInput)) {
    showToast("Veuillez entrer une adresse e-mail valide !");
    emailInput.focus();
    return false;
  }

  // Validation du champ MOT DE PASSE
  if (!validateRequired(passwordInput)) {
    showToast("Veuillez entrer votre mot de passe !");
    passwordInput.focus();
    return false;
  }

  if (!validatePassword(passwordInput)) {
    showToast(
      "Le mot de passe doit contenir au moins 8 caractères, une lettre minuscule, une lettre majuscule et un chiffre !"
    );
    passwordInput.focus();
    return false;
  }

  // Validation de la checkbox CONDITIONS
  if (!validateConditions(conditionsInput)) {
    showToast("Veuillez accepter les conditions d'utilisation !");
    return false;
  }

  return true;
}

// Fonction de gestion de la soumission du formulaire
function handleFormSubmission(event) {
  event.preventDefault();

  // Validation des champs du formulaire
  if (!validateFormFields()) {
    return;
  }

  // Récupération des valeurs des champs du formulaire
  const firstName = document.getElementById("firstName").value;
  const lastName = document.getElementById("lastName").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // Envoi des données au fichier d'inscription
  fetch("inscription.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      firstName: firstName,
      lastName: lastName,
      email: email,
      password: password,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        showToast("Inscription réussie !");
        // Effectuez ici toute autre action nécessaire après l'inscription réussie
      } else {
        showToast("Erreur lors de l'inscription !");
      }
    })
    .catch((error) => {
      showToast("Erreur lors de l'inscription !");
      console.error(error);
    });
}

// Récupération du formulaire et ajout de l'événement de soumission
const lessonForm = document.getElementById("lessonForm");
lessonForm.addEventListener("submit", handleFormSubmission);
