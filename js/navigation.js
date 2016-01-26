jQuery(document).ready(function($) {
    $('#primary-navigation a').mousedown(function( e ) {
        e.preventDefault();
        var target = $( $( this ).attr('href') );

        $('html, body').animate({
            scrollTop: target.offset().top
        }, 1000);
         return false;
    });
});
