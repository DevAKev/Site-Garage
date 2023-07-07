import { showToast} from "./tools.js";

// START - Declaration du formulaire
(function() {
    'use strict'

    // Déclaration du formulaire
    let form = document.getElementById('formConnect');

    form.addEventListener('submit', function(event) {
        Array.from(form.elements).forEach((input) => {
            if (input.type !== "submit") {
                if (!validateFields(input)) {

                    event.preventDefault();
                    event.stopPropagation();

                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    input.nextElementSibling.style.display = 'block';

                } 
                else {
                    input.nextElementSibling.style.display = 'none';
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');

                }
            }
        });
    }, false)
})();

// END - Declaration du formulaire

// START- Fonction de validation
// Validation des champs requis
function validateRequired(input){
    return !(input.value == null || input.value == "");
    }

// Validation du nombre de caractères
function validateLength(input, minLength, maxLength){
    return !(input.value.length < minLength || input.value.length > maxLength);
}

// Validation des caractères : LATIN & LETTRES
function validateText(input){
    return input.value.match("^[A-Za-z]+$")
}

//validation du mot de passe
function validatePassword(input){
    return input.value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/);
}
//==== START Validation des champs du formulaire====//

function validateFields(input){

    let fieldName = input.name;

// Validation du champ NOM
if (fieldName == "lastName") {
    if (!validateRequired(input)) {
        return false;
    }

    if (!validateLength(input, 2, 20)) {
        return false;
    }

    if (!validateText(input)){
        return false;
    }

    return(true);
}

// Validation du champ MOT DE PASSE
if (fieldName == "password") {
    if (!validateRequired(input)) {
        return false;
    }

    if (!validatePassword(input)) {
        return false;
    }

    return (true);
}
}

//==== END Validation des champs du formulaire====//

let members = JSON.parse(localStorage.getItem("members")) || []

/*const members = [
    {
        nom: "Parrot",
        prenom: "Vincent",
        password: "Vparrot31",
    },
]*/

const formConnect = document.querySelector("form");
const toast = document.getElementById("toast");

formConnect.addEventListener("submit", (event) => {
    event.preventDefault();
    
    const lastNameInput = document.getElementById("lastName");
    const passwordInput = document.getElementById("password");

    const nom = lastNameInput.value.trim();
    const password = passwordInput.value.trim();

    if (nom === "" || password === "") {
        showToast("Veuillez saisir votre nom d'utilisateur et votre mot de passe.");
        return;
    }

    console.log("nom : " + nom);
    console.log("mdp : " + password);

    const member = members.find(
        (member) => member.nom === nom && member.password === password
    );

    if (member) {
        localStorage.setItem("member", JSON.stringify(member));
        window.location.href = "Accueil-membre.html";

    } else {
        lastNameInput.value = ""
        passwordInput.value = ""
        showToast("Nom d'utilisateur ou mot de passe incorrect ");
    }
});


