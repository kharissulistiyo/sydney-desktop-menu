;(function($) {

  'use strict'

  if( ('not-exists' != sy_main_nav ) && $('.button-slider').length ) {

    $(window).on('load resize', function() {
      
			if ( matchMedia( 'only screen and (max-width: 1024px)' ).matches ) {

        $('.site-header .col-md-8').html( sy_main_nav );

      }

    });

  }

})(jQuery);
