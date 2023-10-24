$(function filterResults() {
  $("#triForm, #filterForm").on("slidechange change", function () {
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

    fetch(url)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        // console.log(data);
        $(".grid-container").html("");
        for (let dataItem of data) {
          // console.log(dataItem.image);
          getCarImage = dataItem.image;
          let imageUrl = dataItem.image
            ? `uploads/cars/${dataItem.image}`
            : "assets/images/default_car_image.jpg";
          let html = `
        <div class="col-12 col-md-6 col-lg-4 p-3" id="containerCards">
        <div class="row justify-content-around">
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
                <li class="list-group-item">${dataItem.prix} €</li>
                <li class="list-group-item">${dataItem.kilometrage} km</li>
                <li class="list-group-item">${dataItem.carburant}</li>
                <li class="list-group-item">${dataItem.annee_mise_en_circulation}</li>
                </ul>
                </p>
                <a href="./car.php?id=${dataItem.id}" class="btn btn-primary m-4">Voir ce véhicule</a>
                </div>
                </div>
                </div>
                </div>
      `;
          $(".grid-container").append(html);
        }
      })
      .catch((e) => {
        console.error("Error:", e);
      });
  });
});
