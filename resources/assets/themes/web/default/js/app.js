$(document).ready(function() {
    $('.widgets-left-button').on('click', function() {
        $('.widgets-left').toggleClass('showing');
        $('.widgets-right').removeClass('showing');
        $('html').toggleClass('widgets-open');
    });
    $('.widgets-right-button').on('click', function() {
        $('.widgets-right').toggleClass('showing');
        $('.widgets-left').removeClass('showing');
        $('html').toggleClass('widgets-open');
    });

    // Go top
    var duration = 500;
    $(window).scroll(function() {
        if ($(this).scrollTop() > 220) {
            $('.back-to-top').fadeIn(duration);
        } else {
            $('.back-to-top').fadeOut(duration);
        }
    });
         
    $('.back-to-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

    // Magnific Popup
    $.extend(true, $.magnificPopup.defaults, {
        tClose: 'Cerrar (Esc)', // Alt text on close button
        tLoading: 'Cargando...', // Text that is displayed during loading. Can contain %curr% and %total% keys
        gallery: {
            tPrev: 'Anterior', // Alt text on left arrow
            tNext: 'Siguiente', // Alt text on right arrow
            tCounter: '%curr% de %total%' // Markup for "1 of 7" counter
        },
        image: {
            tError: '<a href="%url%">La imagen</a> no ha podido ser cargada.' // Error message when image could not be loaded
        },
        ajax: {
            tError: '<a href="%url%">El contenido</a> no ha podido ser cargado.' // Error message when ajax request failed
        }
    });

    $('.lightbox-image').magnificPopup({type:'image'});

    $('.lightbox-gallery').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });
});
