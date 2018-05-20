  $ = jQuery.noConflict();

  //preloader
  function preloadOff() {
    $('#preloader').delay(350).fadeOut(600,function(){
      $('body').removeClass('preloading');
    });
  }

  $(window).on('load',function () {
    preloadOff();
  });

  setTimeout(preloadOff(),3000);

  function addExpandBtn() {
    // Add expand term-description button
    $('.term-description').append($("<button class='expand-descr'>развернуть</button>"));
    // Click handler
    $('.expand-descr').click(function(e){
      e.preventDefault();
      $(this).text(function(i, text){
        return text === "развернуть" ? "свернуть" : "развернуть";
      })
      $(this).parents('.term-description').toggleClass('open');
      setTimeout(function(){ //timeout required for css animation to finish
        $(document.body).trigger("sticky_kit:recalc");
      },500);
    });
  }

  $(function() {

      //callback popup
      $('.callback-btn').click(function () {
          $('.cb-fade').addClass('active');
      });
      $('input[name="cb-num"]').mask("+7 (999) 999-99-99");
      $('.cb-fade').click(function (e) {
          if (e.currentTarget !== e.target) return;
          $(this).removeClass('active');
      });

      //close popups with esc key
      $(document).keyup(function (e) {
          if (e.keyCode == 27) {
              $('.fade').fadeOut('slow');
          }
      });

      //popup close cross icon
      $('.cb-close').click(function(e) {
          e.preventDefault();
          $(this).parents('.cb-fade').removeClass('active');
      });

      //POPUP FORM SUBMISSION
      window.recapCallback = function recapCallback() {

          //analytics event
          dataLayer.push({
            'event':'autoEvent',
            'eventCategory':'form',
            'eventAction':'sent',
            'eventLabel':'callback'
          });

          var form = $('form.cb-form');

          var cereal = form.serializeArray();

          console.log('cerealize',cereal);

          $.post('/wp-admin/admin-ajax.php', {
            action: 'submit_callback',
            'cb-num':  $('.cb-num', form).val(),
            'g-recaptcha-response': cereal[1].value
          }, function (data) {
            // console.log(data);
            form.addClass('hidden');
            $('.cb-text').remove();
            $('.cb-success').addClass('visible');
          });
        }


      //CEO FORM SUBMISSION
      $('#contact-ceo-form').submit(function(e){
        dataLayer.push({
          'event':'autoEvent',
          'eventCategory':'form',
          'eventAction':'sent',
          'eventLabel':'ceo'
        });
      });

      ////// Clock
      function clock($moment){
        var $disp = $moment.format('HH:mm');
        var $open = moment('09:00','HH:mm');
        var $now = moment($disp, 'HH:mm');
        var $closed = moment('18:00','HH:mm');
        // console.log($open,$now,$closed);
        if ($now.isBetween($open,$closed)) {
          $('#contact-sc-status').text('Открыто').addClass('active');
        } else {
          $('#contact-sc-status').text('Закрыто').removeClass('active');
        }
        $('#contact-sc-time').text($disp);
        setTimeout(function(){ clock($moment.add(1,'m')) }, 60000);
      }

      $.get("/wp-admin/admin-ajax.php",{ action: 'time' }).then(function($time){
        $moment = moment.unix($time).utcOffset(0);
        clock($moment);
      });

      ////// Update mini-cart qty on add to cart
      function update_cqty(){
        $.get("/wp-admin/admin-ajax.php", {
          action: 'cart_qty'
        }).then(function(res){
          $('i#cqty').text(res);
          if (res != 0) $('i#cqty').addClass('visible');
        });
      }
      update_cqty();
      $(document.body).on("added_to_cart", function(){
        update_cqty();
      });
      $(document.body).on("updated_wc_div", function(){
        update_cqty();
      });

      $('a.order-link').click(function(e){
        e.preventDefault();
        var order = $(this).data('order');
        $('table[data-order="'+order+'"]').toggleClass('visible');

        var text = $(this).text();
        $(this).text(
          text == "Посмотреть состав заказа" ? "Скрыть" : "Посмотреть состав заказа");
        });

        $('.input-tel').mask("+7 (999) 999-99-99");

        ////// Auto update cart
        $(document).on('change blur','input.qty', function(){
          $('.woocommerce-cart-form').submit();
        });
        // looks cool but works weird
        // $(document.body).on('change blur',function(){
        //   $(document).trigger('wc_update_cart');
        // })

        ////////////////////////////////////////////////////////////////////////

        ////// svgize mobile menu logo to paint it white
        svgize($('.custom-logo'));

        ////// Toggle mobile menu
        $('.toggle-menu, #mobile-menu a:not(.fjx-more)').click(function(){
          $('#mobile-menu').toggleClass('visible');
        });


        ///// Stickit init
        $('#container').ready(function(e){
          if ($('#secondary').is(':visible')) {
            $ps = $('#secondary .flake_ajax_widget').stick_in_parent({
              parent: $('#container'),
              offset_top: 70,
              spacer: false
            });
          }
        });

        $('.slider-carousel').owlCarousel({
          loop: true,
          // autoplay: true,
          items: 1,
          // autoHeight:true,
          nav: true,
          navContainer: '.slider-shortcode',
          // navElement: 'a',
          navText: ['<svg><use class="prev" xlink:href="#prev"/></svg>','<svg><use class="next" xlink:href="#next"/></svg>'],
        });

        //fancybox
        var $links = $('.fancylink');

        $links.on('click', function() {

        	$.fancybox.open( $links, {
        		smallBtn: true,
            toolbar: false,
            fullScreen: false,
            focus: false,
            slideShow: false,
            thumbs: false,
            animationEffect: false,
        	}, $links.index( this ) );

        	return false;
        });

        addExpandBtn();

  // testy

    ///// owl
    var owl = $('.owl-testy');

    owl.owlCarousel({
      items: 3,
      slideBy: 1,
      margin: 64,
      autoplay: 0,
      loop: true,
      dots: false,
      nav: true,
      navContainer: '.testy-nav',
      navElement: 'a',
      navText: ['<svg><use class="prev" xlink:href="#prev"/></svg>','<svg><use class="next" xlink:href="#next"/></svg>'],
      responsive: {
        0: {
          items: 1
        },
        800: {
          items: 2,
          margin: 32
        },
        1040: {
          items: 3
        }
      }
    });

    // testy end


  // fjx

    function recalc(delay){
      // console.log('delay',delay);
      setTimeout(function(){ //timeout required for css animation to finish
        $(document.body).trigger("sticky_kit:recalc");
      },delay);
    }

    // window.recalc = recalc();

    var $cat = window.location.href.split('/')[4];
    // console.log($cat);
    if ($cat && $cat.length != 0) {
      // console.log('adding class cat');
      var $topActive = $('.flake_ajax_widget a[href$="'+$cat+'/"]');
      $topActive.addClass('active');
      $topActive.parents('.fjx-top').addClass('active open');
      $topActive.parents('.fjx-top').next('ul.fjx-subcat').addClass('active');
      recalc(300);
    }

    // this adds active class to a subcategory
    var $subcat = window.location.href.split('/')[5];
    console.log($subcat);
    if ($subcat && $subcat.length != 0) {
      // console.log('adding class subcat');
      $('.flake_ajax_widget a[href$="'+$subcat+'/"]').addClass('active');
    }



    function getStuff(a, dontPush) {
      $.get(a).then(function(res){
        var $paste = $(res).find('#shop').contents();
        // $('.term-description').remove();
        // console.log($paste);
        $('#shop').empty().append($paste);
        $('select.orderby').niceSelect();

        if (!dontPush) {
          history.pushState({}, "", a);
          // console.log('history pushed');
        }

        addExpandBtn();

        current = 1;

        $('html').animate({
          scrollTop: $('#shop').offset().top - 70
        }, 500, 'swing');
      });
    }

    //get back
    $(window).on('popstate',function(e){
      console.log(location.href);
      getStuff(location.href, true);
    });

    function getMoreStuff(a) {
      $.get(a).then(
        function(res){
          var $paste = $(res).find('ul.products').contents();

          //items counter
          var $showing = parseInt($(res).find('#ic_showing').text());
          var $cur = parseInt($('#ic_showing').text());
          $('#ic_showing').text($cur + $showing);

          // scrolling
          var $yc = $('ul.products').offset().top + $('ul.products').height(); //bottom y coord of already loaded products
          $('html').animate({
            scrollTop: $yc - 140
          }, 500, 'swing');

          $('ul.products').append($paste);
        },
        function(err){
          // alert('nothing left to load');
          console.log(err.status, err.statusText);
        });
    }


    $('a.fjx').click(function(e){
      $('a.fjx.active, li.fjx-top').removeClass('active');
      var link = $(this);
      link.addClass('active');
      link.closest('.fjx-top').addClass('active');
      link.parents('.fjx-subcat').prev('.fjx-top').addClass('active').find('a.fjx.top').addClass('active');
      if ($('body').hasClass('archive')) {
        e.preventDefault();
        e.stopPropagation();
        getStuff(this.href);
        $('title').html(link.text() +' &#8212; Подряд');
      } else {
        // console.log('no way');
      };
    });

    // toggle accordeon item
    $('li.fjx-top').click(function(){
      // $('li.fjx-top').removeClass('open');
      $(this).toggleClass('open');
      $(this).next('ul.fjx-subcat').toggleClass('active');

      recalc(300);
    });




    ////// LOADMORE BTN//////
    current = 1;
    $(document).on('click','#loadmore', function(){
      var parts = window.location.href.split("/");
      var last = parts.pop();
      var lastInt = parseInt(last);
      console.log('last',lastInt,typeof lastInt);
      if (!isNaN(lastInt)) {
        current = lastInt + 1;
        var end = '/' + current;
        console.log('end',end);
        var href = parts.join("/") + end;
      } else {
        console.log('current', current);
        var href = parts.join("/") + '/page/' + parseInt(current + 1);
        current++;
      }

      if (window.location.search) href += window.location.search;

      console.log('href',href);

      getMoreStuff(href);

      if ($(this).data('total') == current) $(this).attr('disabled','true');
    });

    // fjx end

    //make room for footer
    function giveFooterSomeRoom() {
      footer = $('footer#footer');
      padding = footer.outerHeight();
      $('body').css('padding-bottom',padding);
      // console.log('padding applied');
    };

    giveFooterSomeRoom();

    $(window).resize(function(){
      giveFooterSomeRoom();
    });


    // This is what original orderby code looks like
  	// $( '.woocommerce-ordering' ).on( 'change', 'select.orderby', function() {
  	// 	$( this ).closest( 'form' ).submit();
  	// });

    //MY ORDERBY & FILTER CODE
    $( '.woocommerce-ordering' ).off();
    //whole form is serialized
    $(document).on('change', 'select.orderby', function(){
      var $qstr = $(this).closest( 'form' ).serialize();
      // console.log($qstr);
      var $goto = location.origin + location.pathname + '?' + $qstr;
      getStuff($goto);
      $('select.orderby').niceSelect();
    });

    //filter selects design
    $('select.orderby').niceSelect();

  }); //document-ready end
