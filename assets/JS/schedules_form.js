// Fonction de validation
function validateSchedules() {
  // Récupérer tous les champs d'heure et les messages d'erreur correspondants
  const heureOuvertureInputs = document.querySelectorAll(
    'input[name^="heure_ouverture"]'
  );
  const heureFermetureInputs = document.querySelectorAll(
    'input[name^="heure_fermeture"]'
  );
  const heureOuvertureErrorMessages = document.querySelectorAll(
    ".heure-ouverture-error-message"
  );
  const heureFermetureErrorMessages = document.querySelectorAll(
    ".heure-fermeture-error-message"
  );

  // Supprimer tous les messages d'erreur existants
  heureOuvertureErrorMessages.forEach((message) => (message.textContent = ""));
  heureFermetureErrorMessages.forEach((message) => (message.textContent = ""));

  // Vérifier chaque champ d'heure
  let isValid = true;
  for (let i = 0; i < heureOuvertureInputs.length; i++) {
    const heureOuverture = heureOuvertureInputs[i].value.trim(); // Utiliser trim() pour enlever les espaces vides
    const heureFermeture = heureFermetureInputs[i].value.trim(); // Utiliser trim() pour enlever les espaces vides
    const jourSemaine = heureOuvertureInputs[i].parentNode.parentNode
      .querySelector("td[data-day]")
      .getAttribute("data-day");

    // Vérifier si les valeurs sont des chiffres entiers et respectent le format '00:00:00'
    const timeRegex = /^\d{2}:\d{2}:\d{2}$/;

    if (heureOuverture !== "" && !timeRegex.test(heureOuverture)) {
      heureOuvertureErrorMessages[i].textContent =
        "Veuillez saisir une heure valide au format '00:00:00'.";
      isValid = false;
    }

    if (heureFermeture !== "" && !timeRegex.test(heureFermeture)) {
      heureFermetureErrorMessages[i].textContent =
        "Veuillez saisir une heure valide au format '00:00:00'.";
      isValid = false;
    }
  }

  return isValid;
}

// Ajouter un gestionnaire d'événement à la soumission du formulaire
const form = document.getElementById("schedulesForm");
form.addEventListener("submit", function (event) {
  if (!validateSchedules()) {
    event.preventDefault(); // Empêcher la soumission du formulaire si la validation échoue
  }
});
