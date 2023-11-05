// COMPTEUR DE CARACTERES
const caracteristiques = document.getElementById("caracteristiques");
const caracteristiquesCounter = document.getElementById(
  "caracteristiques-counter"
);
caracteristiques.addEventListener("input", function () {
  caracteristiquesCounter.innerHTML = caracteristiques.value.length + "/500";
  if (caracteristiques.value.length > 500) {
    caracteristiquesCounter.style.color = "red";
  } else {
    caracteristiquesCounter.style.color = "black";
  }
});
// COMPTEUR DES OPTIONS
const equipements_options = document.getElementById("equipements_options");
const equipements_optionsCounter = document.getElementById(
  "equipements_optionsCounter"
);
equipements_options.addEventListener("input", function () {
  equipements_optionsCounter.innerHTML =
    equipements_options.value.length + "/500";
  if (equipements_options.value.length > 500) {
    equipements_optionsCounter.style.color = "red";
  } else {
    equipements_optionsCounter.style.color = "black";
  }
});
