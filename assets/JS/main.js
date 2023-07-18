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

function validateFields(input) {
  let fieldName = input.name;

  // Validation du champ PRENOM
  if (fieldName === "firstName") {
    if (!validateRequired(input)) {
      return false;
    }

    if (!validateLength(input, 2, 20)) {
      return false;
    }

    if (!validateText(input)) {
      return false;
    }

    return true;
  }

  // Validation du champ NOM
  if (fieldName === "lastName") {
    if (!validateRequired(input)) {
      return false;
    }

    if (!validateLength(input, 2, 20)) {
      return false;
    }

    if (!validateText(input)) {
      return false;
    }

    return true;
  }

  // Validation du champ EMAIL
  if (fieldName === "email") {
    if (!validateRequired(input)) {
      return false;
    }

    if (!validateEmail(input)) {
      return false;
    }

    return true;
  }

  // Validation du N° de téléphone
  // if (fieldName == "phoneNumber") {
  //   if (!validateRequired(input)) {
  //     return false;
  //   }

  //   if (!validatePhoneNumber(input)) {
  //     return false;
  //   }

  //   return true;
  // }

  // Validation du champ ADRESSE
  /*if (fieldName == "address") {

            if (!validateRequired(input)) {
                return false;
            }

            if (!validateAddress(input)) {
            return false;
        }

            return (true);
        }

        // Validation du champ VILLE
        if (fieldName === "city") {
            if (!validateRequired(input)) {
                return false;
            }

            if (!validateCity(input)) {
                return false;
            }

            return(true);
        }

        // Validation du champ CODE POSTAL
        if (fieldName == "postCode") {

            if (!validateRequired(input)) {
                return false;
            }

            if (!validatepostCode(input)) {
                return false;
            }

            return (true);
        }*/

  // Validation du champ MOT DE PASSE
  if (fieldName === "password") {
    if (!validateRequired(input)) {
      return false;
    }

    if (!validatePassword(input)) {
      return false;
    }

    return true;
  }

  // Validation du champ CONDITIONS
  if (fieldName === "conditions") {
    if (!validateConditions(input)) {
      return false;
    }

    return true;
  }
}

// Enregistrement des données inscription

function validateFields() {
  const firstNameInput = document.getElementById("firstName");
  const lastNameInput = document.getElementById("lastName");
  const emailInput = document.getElementById("email");
  // const phoneNumberInput = document.getElementById("phoneNumber");
  /*const addressinput = document.getElementById("address")
        const cityinput = document.getElementById("city")
        const postalinput = document.getElementById("postCode")*/
  const passwordInput = document.getElementById("password");

  const firstName = firstNameInput.value.trim();
  const lastName = lastNameInput.value.trim();
  const email = emailInput.value.trim();
  // const phoneNumber = phoneNumberInput.value;
  /*const address = addressinput.value
        const city = cityinput.value
        const postal = postalinput.value*/
  const password = passwordInput.value;

  // Validation du champ PRENOM
  if (firstName === "") {
    showToast("Veuillez entrer votre prénom !");
    firstNameInput.focus();
    return false;
  }

  // Validation du champ NOM
  if (lastName === "") {
    showToast("Veuillez entrer votre nom !");
    lastNameInput.focus();
    return false;
  }

  // Validation du champ EMAIL
  if (email === "") {
    showToast("Veuillez entrer votre adresse e-mail !");
    emailInput.focus();
    return false;
  }

  // Validation du champ MOT DE PASSE
  if (password === "") {
    showToast("Veuillez entrer votre mot de passe !");
    passwordInput.focus();
    return false;
  }

  return true;
}

// Vérification de l'utilisateur existant
function checkUserExists(email) {
  // Créer un objet XMLHttpRequest
  var xhr = new XMLHttpRequest();

  // Définir la fonction de rappel pour gérer la réponse de la requête
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // La requête s'est terminée avec succès
        var response = xhr.responseText;
        if (response === "true") {
          // L'utilisateur existe dans la base de données
          return true;
        } else {
          // L'utilisateur n'existe pas dans la base de données
          return false;
        }
      } else {
        // La requête a échoué
        console.log("Erreur lors de la requête AJAX");
        return false;
      }
    }
  };

  // Préparer et envoyer la requête AJAX
  xhr.open("POST", "inscription.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("email=" + email);
}

// Gestion de la soumission du formulaire
function handleFormSubmission(event) {
  event.preventDefault();

  // Récupération des valeurs des champs du formulaire
  const firstName = document.getElementById("firstName").value;
  const lastName = document.getElementById("lastName").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  // Validation des champs
  if (!validateFields()) {
    return;
  }

  // Vérification de l'utilisateur existant
  if (checkUserExists(email)) {
    showToast("Attention cet utilisateur existe déjà !");
    return;
  }

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
