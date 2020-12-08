$(document).ready(function() {

    // เปิดใช้งาน js ของ material auto
    M.AutoInit();

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

});
