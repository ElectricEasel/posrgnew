/** custom.js **/

(function($){
    $(document).ready(function(){

        /*======= For Banner carousel on Index Page  =================== */

        try
        {
            $('#myCarousel').carousel({
                interval: 6000
            });
        }
        catch (someException)
        {
        }

        try
        {
            $('#testiCarousel').carousel({
                interval:4000
            });
        }
        catch (someException)
        {
        }


        /*======= For parallex bg =================== */
        jQuery.each( jQuery('.testimonials'), function(){
            jQuery('.bg', this).parallax("50%", 0.4);
        });


        /*=======  For Scroll to top  =================== */
        try
        {
            $('.top-arrow a').click(function(event) {
                event.preventDefault();
                var liIndex = $(this).index();
                var contentPosTop = $('html').eq(liIndex).position().top;

                $('html, body').stop().animate({
                    scrollTop : contentPosTop
                }, 1500);
            });
        }
        catch (someException)
        {
        }

        /*=================== onScroll Animation =======================*/
        try
        {
            $(window).scroll(function(){

                /* Why choose us animation*/
                // if  (isScrolledIntoView($(".about-block"))){
                //   $(".middle .ol-circle li").addClass('animated');
                //}

                /*  Recent work */
                if  (isScrolledIntoView($(".recent-work"))){
                    $(".recent-item").addClass('animated');
                }

            });
        }
        catch (someException)
        {
        }

        function isScrolledIntoView(elem)
        {
            try
            {
                var eleoffset= 100;
                var docViewTop = $(window).scrollTop();
                var docViewBottom = docViewTop + $(window).height() ;

                var elemTop = $(elem).offset().top  ;
                var elemBottom = elemTop + $(elem).height() - eleoffset;

                return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
            }
            catch (someException)
            {
            }
        }

        function isScrolledIntoViewhide(elem)
        {
            try
            {
                var eleoffset= 200;
                var docViewTop = $(window).scrollTop();
                var docViewBottom = docViewTop + $(window).height() ;

                var elemTop = $(elem).offset().top + eleoffset;
                var elemBottom = elemTop + $(elem).height() - eleoffset;

                return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
            }
            catch (someException)
            {
            }
        }

        /*=================== End onScroll Animation =======================*/

    });
})(jQuery);

/*global jQuery */
/*jshint multistr:true browser:true */
/*!
 * FitVids 1.0
 *
 * Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
 * Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
 * Released under the WTFPL license - http://sam.zoy.org/wtfpl/
 *
 * Date: Thu Sept 01 18:00:00 2011 -0500
 */

(function( $ ){

    "use strict";

    $.fn.fitVids = function( options ) {
        var settings = {
            customSelector: null
        };

        var div = document.createElement('div'),
            ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

        div.className = 'fit-vids-style';
        div.innerHTML = '&shy;<style>         \
      .fluid-width-video-wrapper {        \
         width: 100%;                     \
         position: relative;              \
         padding: 0;                      \
      }                                   \
                                          \
      .fluid-width-video-wrapper iframe,  \
      .fluid-width-video-wrapper object,  \
      .fluid-width-video-wrapper embed {  \
         position: absolute;              \
         top: 0;                          \
         left: 0;                         \
         width: 100%;                     \
         height: 100%;                    \
      }                                   \
    </style>';

        ref.parentNode.insertBefore(div,ref);

        if ( options ) {
            $.extend( settings, options );
        }

        return this.each(function(){
            var selectors = [
                "iframe[src*='player.vimeo.com']",
                "iframe[src*='www.youtube.com']",
                "iframe[src*='www.youtube-nocookie.com']",
                "iframe[src*='www.kickstarter.com']",
                "object",
                "embed"
            ];

            if (settings.customSelector) {
                selectors.push(settings.customSelector);
            }

            var $allVideos = $(this).find(selectors.join(','));

            $allVideos.each(function(){
                var $this = $(this);
                if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
                var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
                    width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
                    aspectRatio = height / width;
                if(!$this.attr('id')){
                    var videoID = 'fitvid' + Math.floor(Math.random()*999999);
                    $this.attr('id', videoID);
                }
                $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
                $this.removeAttr('height').removeAttr('width');
            });
        });
    };

    $(document).ready(function(){
        try {
            $(".video-container").fitVids();
        } catch (elementNotExistsException) {}
    });
})( jQuery );

/*Back to Top */
			(function($) {
				$(document).ready(function() {
			// Show or hide the sticky footer button
			$(window).scroll(function() {
				if ($(this).scrollTop() > 200) {
					$('.go-top').fadeIn(200);
				} else {
					$('.go-top').fadeOut(200);
				}
			});

			// Animate the scroll to top
			$('.go-top').click(function(event) {
				event.preventDefault();

				$('html, body').animate({scrollTop: 0}, 300);
			});
		});
		}) (jQuery);