jQuery(document).ready(function($){
	
	/* getting viewport width */
	var responsive_viewport = $(window).width();
	
	/* if is below 481px */
	if (responsive_viewport > 1) {
		
		$('.mh-xs').matchHeight();
		
	} /* end smallest screen */
	
	/* if is larger than 481px */
	if (responsive_viewport > 481) {
	
		$('.mh-sm').matchHeight();
	
	} /* end larger than 481px */
	
	/* if is above or equal to 768px */
	if (responsive_viewport >= 768) {
		
		$('.mh').matchHeight();
	
	}
	/* off the bat large screen actions */
	if (responsive_viewport > 1030) {
	
	}
	
	$('body.home #below-content .module, .service-box').matchHeight();

    $('.navbar-nav .dropdown-toggle').removeAttr('data-toggle');

    $('#mfc').chosen();

    // reveals caret when a menu item with 'no-caret' class has visible children (fields only visible for logged in users)
    var parent = $('ul.nav.menu a.no-caret').parent();
    parent.each(function(){
        $(this).children('ul').children('li').each(function(){
            if (!$(this).children('a').hasClass('hide')) {
                $(this).parent().parent().children('a.no-caret').removeClass('no-caret');
            } else {
                $(this).hide();
            }
        })
    });

    $('.fancybox').fancybox();
	
});