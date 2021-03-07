;(function($) {

  'use strict'

  if( ('not-exists' != sy_main_nav ) ) {

    // $(window).on('load resize', function() {

			if ( matchMedia( 'only screen and (max-width: 1024px)' ).matches ) {

        $('.site-header .col-md-8').remove();
        $('.site-header .col-md-8').html( sy_main_nav );

        $('.site-header .row').append('<div class="col-md-8">'+ sy_main_nav +'</div>');

      }

    // });

  }

})(jQuery);
