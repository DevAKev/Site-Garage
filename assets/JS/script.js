$(window).scroll(function () {
  var scrollPos = $(window).scrollTop();
  var windowHeight = $(window).height();

  $(".card").each(function () {
    var offsetTop = $(this).offset().top;

    if (
      scrollPos + windowHeight > offsetTop &&
      scrollPos < offsetTop + windowHeight
    ) {
      if (!$(this).hasClass("card-visible")) {
        $(this).addClass("card-visible");
      }
    } else {
      $(this).removeClass("card-visible");
    }
  });
});
