$(document).ready(function() {
    $('.mobile-menu-trigger').on('click', function (e) {
        e.preventDefault();
        $('#mobile-menu').fadeIn('fast', function(){
            $('#mobile-menu').addClass('open');
        });
    });

    $('.close-menu, #mobile-menu .overlay').on('click', function (e) {
        e.preventDefault();
        $('#mobile-menu').removeClass('open').hide();
    });
});