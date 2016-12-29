/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

 (function($) {

  // Use this variable to set up the common and page specific functions. If you 
  // rename this variable, you will also need to rename the namespace below.
  var Roots = {
    // All pages
    common: {
      init: function() {
        // JavaScript to be fired on all pages
        
        /*** Fix the woochimp box */
        var $wooForm = $('#woochimp_registration_form_widget');

        // Move the form items outside the table
        $wooForm.find('input, button')
        .prependTo($wooForm);
        
        // Remove the table
        $wooForm.find('table').remove();
        
        // Wrap the form items in a div
        $wooForm.find('input').addClass('form-control').each(function () {
          $(this).next('button')
          .andSelf()
          .wrapAll('<div class="input-group"/>');
        });
        
        // Wrap the button in a div
        $wooForm.find('button').addClass('btn btn-default').wrap('<span class="input-group-btn"></span>');
        /*******/


        // Sort the affix menu bar
        $(function() {

          function stockColours()
          {
          //change classes based on stock label
          if ( $('p.stock:contains("in stock")') )
          {
            $('p.stock').addClass('text-success');
          }
        }

          //activate fancybox for image links
          $('.zoom').fancybox({
            padding: 0
          });


          // Activate the sticky menu
          $('#header-masthead').imagesLoaded(function() {
            var offset = $('#header-masthead').height();
            $('header.navbar').affix({
              offset: {
                top: offset
              }
            });
          });

          //activate masonary, only if it's loaded
          if (typeof(jQuery().masonry) === 'function') {
            $('#masonary-container').imagesLoaded(function() {
              var $container = $('#masonary-container');
              $container.masonry({
                itemSelector: '.img-container',
                gutter: ".gutter-sizer"
              });
            });
          }

          //Add the 'zoom' class to image links
          $('a[href*=".png"], a[href*=".gif"], a[href*=".jpeg"], a[href*=".jpg"]').each(function() {
            // Prevent adding zoom class to query-string image links
            if (this.href.indexOf('?') < 0) {
              $(this).addClass('zoom');
            }
          });

          //activate fancybox for vid links
          $('a[rel=fancybox-media]').fancybox({
            padding: 0,
            title: false,
            helpers: {
              media: true
            }
          });

          stockColours();
          $('.variations select').change(function(){
            //alert('you changed!');
            stockColours();
          });

        }); // End readiness
}
},
    // Home page
    home: {
      init: function() {
        // JavaScript to be fired on the home page
        var $wwsLink = $('#who-wears-serge-link');
        $wwsLink.imagesLoaded(function(){
          $wwsLink.scrollify({loopTime: 20000});
        });
        
      }
    },
    // About us page, note the change from about-us to about_us.
    about_us: {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    },
    who_wears_serge_denimes: {
      init: function() {

      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var namespace = Roots;
      funcname = (funcname === undefined) ? 'init' : funcname;
      if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      UTIL.fire('common');

      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
      });
    }
  };

  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.

function isMobile() 
{
 if(window.innerWidth <= 600) {
   return true;
 } else {
   return false;
 }
}

