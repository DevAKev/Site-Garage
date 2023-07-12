const member = JSON.parse(localStorage.getItem("member"));
const usernameSpan = document.getElementById("username");

if (!member) window.location.href = "Connexion.php";
usernameSpan.textContent = member.prenom;

const deconnexionButton = document.getElementById("deconnexion");

deconnexionButton.addEventListener("click", () => {
  localStorage.removeItem("member");
  window.location.href = "Connexion.php";
});
