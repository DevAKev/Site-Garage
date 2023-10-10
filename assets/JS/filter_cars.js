$(document).ready(function () {
  // SELECTIONNER LES ELEMENTS DU SLIDER PAR ID
  let sliderPrice = $("#price-slider");

  // INITIALISATION
  sliderPrice.slider({
    range: true, // ACTIVER LA SELECTION D'UNE PLAGE DE VALEURS
    min: 0, // VAL MIN
    max: 500000, // VAL MAX
    values: [0, 500000],
    step: 1000, // PAS D'INCREMENTATION DU SLIDER
    create: function () {
      // AFFICHAGE DES VAL INITIALES DU RANGE DANS LA DIV
      let minPrice = sliderPrice.slider("values", 0);
      let maxPrice = sliderPrice.slider("values", 1);
      $("#price-values").text(minPrice + " € " + " - " + maxPrice + " € ");
    },
    slide: function (event, ui) {
      // METTRE A JOUR LES VALEURS DES INPUTS CACHES
      $("#minPrice").val(ui.values[0]);
      $("#maxPrice").val(ui.values[1]);

      // METTRE A JOUR LES VALEURS DU RANGE DANS LA DIV EN TEMPS REEL
      $("#price-values").text(
        ui.values[0] + " € " + " - " + ui.values[1] + " € "
      );
    },
  });
});

$(document).ready(function () {
  let sliderkilometrage = $("#kilometrage-slider");

  sliderkilometrage.slider({
    range: true,
    min: 0,
    max: 250000,
    values: [0, 250000],
    step: 10000, // Modif du pas d'incrémentation du slider
    create: function () {
      let minkilometrage = sliderkilometrage.slider("values", 0);
      let maxkilometrage = sliderkilometrage.slider("values", 1);
      $("#kilometrage-values").text(
        minkilometrage + " km " + " - " + maxkilometrage + " km "
      );
    },
    slide: function (event, ui) {
      $("#minkilometrage").val(ui.values[0]);
      $("#maxkilometrage").val(ui.values[1]);
      $("#kilometrage-values").text(
        ui.values[0] + " km " + " - " + ui.values[1] + " km "
      );
    },
  });
});

$(document).ready(function () {
  let sliderAnnee = $("#annee-slider");

  sliderAnnee.slider({
    range: true,
    min: 1980,
    max: 2023,
    values: [1980, 2023],
    step: 1,
    create: function () {
      let minAnnee = sliderAnnee.slider("values", 0);
      let maxAnnee = sliderAnnee.slider("values", 1);
      $("#annee-values").text(minAnnee + " " + " - " + maxAnnee + " ");
    },
    slide: function (event, ui) {
      $("#minAnnee").val(ui.values[0]);
      $("#maxAnnee").val(ui.values[1]);
      $("#annee-values").text(ui.values[0] + " " + " - " + ui.values[1] + " ");
    },
  });
});

// START SCRIPT CARDS VEHICULES
$(document).ready(function () {
  // FORM HIDDEN AU CHARGEMENT DE LA PAGE
  $("#card_body_form").hide();
  // AU CLICK SUR UN LIEN DE LA NAVBAR DE LA CARTE
  $(".card-nav-link").click(function (event) {
    event.preventDefault();

    // EMPCHE LA PROPAGATION DE L'EVENEMENT
    event.stopPropagation();

    // RECUPERATION DE L'ID DU LIEN HREF
    let target = $(this).attr("href");

    // AFFICHAGE DU CONTENU CORRESPONDANT ET HIDDEN DES AUTRES
    if (target === "#card_body_form") {
      $("#card_body_info").hide();
      $("#card_body_form").show();

      // CLASS ACTIVE SUR LE LIEN DU FORMULAIRE
      $(".card-nav-link").removeClass("active");
      $(this).addClass("active");
    } else {
      $("#card_body_info").show();
      $("#card_body_form").hide();
      // CLASS ACTIVE SUR LE LIEN DES INFOS DU VEHICULE
      $(".card-nav-link").removeClass("active");
      $('[href="#card_body_info"]').addClass("active");
    }
  });
});
// END SCRIPT
