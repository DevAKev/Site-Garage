import { showToast } from "./tools.js";

// START - Declaration du formulaire
(function () {
  "use strict";

  // Déclaration du formulaire
  let form = document.getElementById("lessonForm");

  form.addEventListener(
    "submit",
    function (event) {
      Array.from(form.elements).forEach((input) => {
        if (input.type !== "submit") {
          if (!validateFields(input)) {
            event.preventDefault();
            event.stopPropagation();

            input.classList.remove("is-valid");
            input.classList.add("is-invalid");
            input.nextElementSibling.style.display = "block";
          } else {
            input.nextElementSibling.style.display = "none";
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");
          }
        }
      });
    },
    false
  );
})();

// END - Declaration du formulaire

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
function validatePhoneNumber(input) {
  return input.value.match(/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/);
}

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
  if (fieldName == "firstName") {
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
  if (fieldName == "lastName") {
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
  if (fieldName == "email") {
    if (!validateRequired(input)) {
      return false;
    }

    if (!validateEmail(input)) {
      return false;
    }

    return true;
  }

  // Validation du N° de téléphone
  if (fieldName == "phoneNumber") {
    if (!validateRequired(input)) {
      return false;
    }

    if (!validatePhoneNumber(input)) {
      return false;
    }

    return true;
  }

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
  if (fieldName == "password") {
    if (!validateRequired(input)) {
      return false;
    }

    if (!validatePassword(input)) {
      return false;
    }

    return true;
  }

  // Validation du champ CONDITIONS
  if (fieldName == "conditions") {
    if (!validateConditions(input)) {
      return false;
    }

    return true;
  }
}

// Enregistrement des données inscription
let members = JSON.parse(localStorage.getItem("members")) || [];

const lessonForm = document.getElementById("lessonForm");
const toast = document.getElementById("toast");

lessonForm.addEventListener("submit", function (event) {
  event.preventDefault();

  const firstNameInput = document.getElementById("firstName");
  const lastNameInput = document.getElementById("lastName");
  const emailInput = document.getElementById("email");
  const phoneNumberInput = document.getElementById("phoneNumber");
  /*const addressinput = document.getElementById("address")
        const cityinput = document.getElementById("city")
        const postalinput = document.getElementById("postCode")*/
  const passwordInput = document.getElementById("password");

  const firstName = firstNameInput.value;
  const lastName = lastNameInput.value;
  const email = emailInput.value;
  const phoneNumber = phoneNumberInput.value;
  /*const address = addressinput.value
        const city = cityinput.value
        const postal = postalinput.value*/
  const password = passwordInput.value;

  if (members) {
    const isExistMember = members.find((member) => member.email === email);
    if (isExistMember) {
      showToast("Attention cet utilisateur existe déjà !");
      return;
    }
  }

  const newMember = {
    prenom: firstName,
    nom: lastName,
    email: email,
    phone: phoneNumber,
    /*address: address,
                city: city,
                postal: postal,*/
    password: password,
  };

  members.push(newMember);

  localStorage.setItem("members", JSON.stringify(members));
  window.location.href = "Connexion.php";

  showToast("Inscription réussie !");
});
