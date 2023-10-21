$("#sortBy").on("input propertychange", () => {
  let sortBy = $("#sortBy").val();

  const url = "filterTri.php?sortBy=" + sortBy;
  fetch(url)
    .then((response) => {
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
      console.log(e);
    });
});
