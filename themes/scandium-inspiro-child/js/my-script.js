jQuery(document).ready(function( $ ) {
	
  $('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top+200
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

  $('#div_slick') ? $('#div_slick').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 8000,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true,
    arrows: false,
    variableWidth: false
  }) : '';


  $('#div_slick_testimonial') ? $('#div_slick_testimonial').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true,
    arrows: true,
    variableWidth: false,
    nextArrow: '<i class="myArrow fa fa-angle-right"></i>',
    prevArrow: '<i class="myArrow fa fa-angle-left"></i>',
  }) : '';


  

  $('#div_slick_logos') ? $('#div_slick_logos').slick({
    dots: false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true,
    arrows: false,
    variableWidth: false
  }) : '';



  $('#div_slick_logos_min') ? $('#div_slick_logos_min').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true,
    arrows: false,
    variableWidth: false
  }) : '';

  $('#div_slick_asesores_min') ? $('#div_slick_asesores_min').slick({
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000,
    speed: 300,
    arrows: false,
    slidesToShow: 1,
    centerMode: true,
    variableWidth: true
  }) : '';



});
