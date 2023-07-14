var multipleCardCarousel = document.querySelector(
    ".carousel-cards"
  );
  if (window.matchMedia("(min-width: 768px)").matches) {
    $(multipleCardCarousel).removeClass("slide");
    var carousel = new bootstrap.Carousel(multipleCardCarousel, {
      interval: false,
    });
    var carouselWidth = $(".carousel-cards .carousel-inner")[0].scrollWidth;
    var cardWidth = $(".carousel-cards .carousel-item").width();
    var scrollPositionPreferidos = 0;
    var scrollPositionNovedades = 0;

    //Carousel "Preferidos de la semana"
    $("#carouselWeeklyCards .carousel-control-next").on("click", function () {
      if (scrollPositionPreferidos < carouselWidth - cardWidth * 4) {
        scrollPositionPreferidos += cardWidth;
        $("#carouselWeeklyCards .carousel-inner").animate(
          { scrollLeft: scrollPositionPreferidos },
          600
        );
      }else{
        scrollPositionPreferidos = 0;
        $("#carouselWeeklyCards .carousel-inner").animate(
            { scrollLeft: scrollPositionPreferidos },
            600
        );
      }
    });
    $("#carouselWeeklyCards .carousel-control-prev").on("click", function () {
      if (scrollPositionPreferidos >= 1) {
        scrollPositionPreferidos -= cardWidth;
        $("#carouselWeeklyCards .carousel-inner").animate(
          { scrollLeft: scrollPositionPreferidos },
          600
        );
      }else{
        scrollPositionPreferidos = cardWidth * 6;
        $("#carouselWeeklyCards .carousel-inner").animate(
            { scrollLeft: scrollPositionPreferidos },
            600
          );
      }
    });

    //Carousel "Novedades"
    $("#carouselNewCards .carousel-control-next").on("click", function () {
        if (scrollPositionNovedades < carouselWidth - cardWidth * 4) {
          scrollPositionNovedades += cardWidth;
          $("#carouselNewCards .carousel-inner").animate(
            { scrollLeft: scrollPositionNovedades },
            600
          );
        }else{
            scrollPositionNovedades = 0;
            $("#carouselNewCards .carousel-inner").animate(
                { scrollLeft: scrollPositionNovedades },
                600
            );
          }
      });
      $("#carouselNewCards .carousel-control-prev").on("click", function () {
        if (scrollPositionNovedades >= 1) {
          scrollPositionNovedades -= cardWidth;
          $("#carouselNewCards .carousel-inner").animate(
            { scrollLeft: scrollPositionNovedades },
            600
          );
        }else{
            scrollPositionNovedades = cardWidth * 6;
            $("#carouselNewCards .carousel-inner").animate(
                { scrollLeft: scrollPositionNovedades },
                600
              );
          }
      });
  } else {
    $(multipleCardCarousel).addClass("slide");
  }