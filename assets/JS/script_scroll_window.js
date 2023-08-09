// ÉCOUTEUR D'ÉVÉNEMENT POUR LE DÉFILEMENT DE LA PAGE
$(window).scroll(function () {
  // OBTENIR LA POSITION DE DÉFILEMENT ACTUELLE
  var scrollPos = $(window).scrollTop();
  // OBTENIR LA HAUTEUR DE LA FENÊTRE DU NAVIGATEUR
  var windowHeight = $(window).height();

  // POUR CHAQUE ÉLÉMENT AVEC LA CLASSE "card"
  $(".card").each(function () {
    // OBTENIR LA POSITION SUPÉRIEURE DE L'ÉLÉMENT
    var offsetTop = $(this).offset().top;

    // VÉRIFIER SI L'ÉLÉMENT EST DANS LA VUE ACTUELLE DE L'ÉCRAN
    if (
      scrollPos + windowHeight > offsetTop &&
      scrollPos < offsetTop + windowHeight
    ) {
      // SI L'ÉLÉMENT N'A PAS LA CLASSE "card-visible", L'AJOUTER
      if (!$(this).hasClass("card-visible")) {
        $(this).addClass("card-visible");
      }
    } else {
      // SI L'ÉLÉMENT N'EST PAS DANS LA VUE ACTUELLE, RETIRER LA CLASSE "card-visible"
      $(this).removeClass("card-visible");
    }
  });
});

/* Ce code JavaScript ajoute ou supprime la classe "card-visible" à condition que les éléments 
avec la classe "card" soit visibles à l'écran pendant le défilement. Lorsqu'un élément est visble 
à l'écran, la classe "card-visible" est ajoutée, ce qui peut déclencher des animations ou des 
transitions pour les éléments. Si l'élément n'est plus dans la vue actuelle de 
l'écran, la classe "card-visible" est supprimée. */
