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

    // hides submenu ul when children are all hidden
    var parent = $('ul.dropdown-menu li.parent');
    parent.each(function(){
        $(this).children('ul').each(function(){
            var empty = true;
            $(this).children('li').each(function(){
                if (!$(this).children('a').hasClass('hide')) {
                    empty = false;
                    return false;
                }
            });
            if (empty) {
                $(this).parent().parent().children('li').children('a').addClass('no-caret');
                $(this).hide();
                $(this).css('padding','0');
                $(this).css('border','0');
            }
        })
    });
	
});