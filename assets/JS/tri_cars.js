$(function filterResults() {
  // CONSTRUCTION DE L'URL PAR DEFAUT POUR AFFICHER TOUS LES VEHICULES
  const defaultUrl = "filterTri.php?sortBy=recentes";

  // FONCTION POUR CHARGER ET AFFICHER LES VEHICULES EN FONCTION DE L'URL FOURNIE
  function loadVehicles(url) {
    fetch(url)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        // EFFACE LE CONTENU DE LA DIV AVANT DE L'AFFICHER
        $(".grid-container").html("");
        // SI AUCUN RESULTAT, AFFICHE UN MESSAGE D'ERREUR
        if (data.length === 0) {
          $(".grid-container").html(
            '<div id="noResults" class="alert alert-warning text-center">Ouuupsss... Aucun résultat, veuillez réinitialiser votre recherche.</div>'
          );
        } else {
          //CONSTRUCTION DU HTML POUR AFFICHER LES VEHICULES DANS LA GRILLE
          for (let dataItem of data) {
            let imageUrl = dataItem.image
              ? `uploads/cars/${dataItem.image}`
              : "assets/images/default_car_image.jpg";
            const prixFormate = new Intl.NumberFormat("fr-FR", {
              style: "currency",
              currency: "EUR",
              maximumFractionDigits: 0,
            }).format(dataItem.prix);
            const kilometrageFormate = new Intl.NumberFormat("fr-FR", {
              style: "decimal",
              maximumFractionDigits: 0,
            }).format(dataItem.kilometrage);
            let html = `
              <div class="card" id="filterCards">
                <div class="card-header bg-transparent d-flex justify-content-between">
                  <h6 class="card-title">${dataItem.marque}</h6>
                  <h6>${dataItem.modele}</h6>
                </div>
                <a href="car.php?id=${dataItem.id}">
                  <img src="${imageUrl}" class="card-img-top" alt="photo ${dataItem.marque}">
                </a>
                <div class="card-body">
                  <p class="card-text">
                    <ul class="list-group">
                      <li class="list-group-item">${prixFormate}</li>
                      <li class="list-group-item">${kilometrageFormate} km</li>
                      <li class="list-group-item">${dataItem.carburant}</li>
                      <li class="list-group-item">${dataItem.annee_mise_en_circulation}</li>
                    </ul>
                  </p>
                  <a href="./car.php?id=${dataItem.id}" class="btn btn-primary m-4">Voir ce véhicule</a>
                </div>
              </div>
            `;
            $(".grid-container").append(html);
          }
        }
      })
      .catch((e) => {
        console.error("Error:", e);
      });
  }
  // CHARGE ET AFFICHE LES VEHICULES AU CHARGEMENT DE LA PAGE EN UTILISANT L'URL PAR DEFAUT
  loadVehicles(defaultUrl);
  // GESTION DES EVENEMENTS DE CHANGEMENT DE TRI OU DE FILTRE
  $("#triForm, #filterForm").on("slidechange change", function () {
    // CONSTRUCTION DE L'URL EN FONCTION DES FILTRES ET TRI SELECTIONNES
    let sortBy = $("#sortBy").val();
    let marque = $("#marque").val();
    let carburant = $("#fuel-type").val();
    let minPrice = $("#minPrice").val();
    let maxPrice = $("#maxPrice").val();
    let minKilometrage = $("#minkilometrage").val();
    let maxKilometrage = $("#maxkilometrage").val();
    let minAnnee = $("#minAnnee").val();
    let maxAnnee = $("#maxAnnee").val();
    const url = `filterTri.php?sortBy=${sortBy}&marque=${marque}&carburant=${carburant}&minPrice=${minPrice}&maxPrice=${maxPrice}&minkilometrage=${minKilometrage}&maxkilometrage=${maxKilometrage}&minAnnee=${minAnnee}&maxAnnee=${maxAnnee}`;

    // CHARGE ET AFFICHE LES VEHICULES EN FONCTION DE L'URL CONSTRUITE
    loadVehicles(url);
  });
});
