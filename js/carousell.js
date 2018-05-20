(function($){
  /// tabbed owl init
  var owl = $('.prod-carousel.tabbed');

  var $navText = ['<svg><use class="prev" xlink:href="#prev"/></svg>','<svg><use class="next" xlink:href="#next"/></svg>'];

  var $res = {
    0: {
      items:1,
      slideBy:1,
    },
    460: {
      items:2,
      slideBy:2,
    },
    768: {
      items:3,
      slideBy:3,
    }
  };

  owl.owlCarousel({
    loop: true,
    // autoplay: true,
    dots: false,
    // nav: true,
    navContainer: '.carousel-nav',
    navElement: 'a',
    navText: $navText,
    responsive : $res
  });

  /// similar owl init
  $('.prod-carousel.related').owlCarousel({
    items: 3,
    slideBy: 3,
    loop: false,
    dots: false,
    navContainer: '.related .carousel-nav',
    navElement: 'a',
    navText: $navText,
    responsive: $res
  });

  /// recent owl init
  $('.prod-carousel.recent').owlCarousel({
    items: 3,
    slideBy: 3,
    loop: false,
    dots: false,
    navContainer: '.recent .carousel-nav',
    navElement: 'a',
    navText: $navText,
    responsive: $res
  });

  function loadOwl(type){
    if (owl.length == 0) return false;
    var url = "/wp-admin/admin-ajax.php";
    $.get(url, {
      action: 'load_' + type,
    }).then(function(res){
      owl.trigger('replace.owl.carousel', res).trigger('refresh.owl.carousel');
    });
  }

  loadOwl('featured');

  $('.carousel-tab').click(function(){
    $(this).addClass('active').siblings().removeClass('active');
    loadOwl($(this).data('type'));
  });

})(jQuery);
