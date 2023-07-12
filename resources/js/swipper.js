import Swiper from 'swiper';

jQuery(document).ready(function(){

    //Initiate the slider
    initSlider();
    function initSlider() {
        $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            animateOut: 'fadeOut',
            autoHeight: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            dots: true,
            lazyLoad: true,
            onDrag: stopSlider
            // onInitialized: startProgressBar,
            // onTranslate: resetProgressBar,
            // onTranslated: startProgressBar
        });
    }

    // When the slider is dragged it will be stopped
    function stopSlider(event) {
        var heroPeepsSlider = $('#myCarousel');
        heroPeepsSlider.trigger('stop.owl.autoplay');
    }

    // Progress Bars
    function startProgressBar() {
        $(".slide-progress").css({
            width: "100%",
            transition: "width 6000ms"
        });
    }
    function resetProgressBar() {
        $(".slide-progress").css({
            width: 0,
            transition: "width 0s"
        });
    }
});

// Add Keyboard Functionality
jQuery(document).keyup(function (event) {
    var heroPeepsSlider = jQuery("#myCarousel");
    // handle cursor keys
    heroPeepsSlider.trigger('stop.owl.autoplay');
    if (event.keyCode == 37) {
        // go left
        heroPeepsSlider.trigger('prev.owl.carousel');
    } else if (event.keyCode == 39) {
        // go right
        heroPeepsSlider.trigger('next.owl.carousel');
    }
});
