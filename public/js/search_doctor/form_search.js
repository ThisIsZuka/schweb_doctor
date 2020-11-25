$(document).ready(function() {




    $('select').formSelect();

    // navbar scroll
    navbar = $('.header');
    navbar.removeClass('alt-color');
    $(window).scroll(function() {
        var scrollPos = $(window).scrollTop(),
            navbar = $('.header');

        if (scrollPos > 10) {
            navbar.addClass('alt-color');
        } else {
            navbar.removeClass('alt-color');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, options);
    });
    $('.sidenav').sidenav();
    //End navbar scroll

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.carousel');
        var instances = M.Carousel.init(elems, options);
    });

    $('.carousel').carousel();

});