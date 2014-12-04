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

    $('#home-carousel').carousel({
        interval: 6000
    })

    // mobile menu changes in behavior
    var mobile_parent = $('#sidebar li.deeper > a');

    mobile_parent.click(function(){
        var sub_dropdown_id = $(this).prev().attr('href');
        var sub_dropdown = $(sub_dropdown_id);

        if (!$(this).parent().parent().hasClass('dropdown-menu')) {
            mobile_parent.each(function(){
                $(this).css('margin-bottom','0');
                $(this).removeClass('selected');
            });
        }

        var top = $(this).offset().top + $(this).outerHeight(true) - 5; // - 5 is due to the border-top
        var sub_height = sub_dropdown.outerHeight(true);

        if (sub_dropdown.css('left') != '0' && sub_dropdown.css('left') != '0px') {
            if (!$(this).parent().parent().hasClass('dropdown-menu')) {
                mobile_parent.each(function(){
                    $($(this).prev().attr('href')).css('left','100%');
                });
            }
            mobile_parent.each(function(){
                $(this).css('margin-bottom', '0');
            });
            $(this).css('margin-bottom', sub_height);
            if (!$(this).parent().parent().hasClass('dropdown-menu')) {
                $(this).addClass('selected');
            } else {
                $(this).addClass('selected-inner');
                $(this).removeClass('selected');
            }
            sub_dropdown.css('top', top);
            sub_dropdown.css('left', '0');
        } else {
            if (!$(this).parent().parent().hasClass('dropdown-menu')) {
                mobile_parent.each(function(){
                    $($(this).prev().attr('href')).css('left','100%');
                });
            }

            $(this).css('margin-bottom', '0');
            if (!$(this).parent().parent().hasClass('dropdown-menu')) {
                $(this).removeClass('selected');
            } else {
                $(this).addClass('selected');
                $(this).removeClass('selected-inner');
            }
            sub_dropdown.css('top', '0');
            sub_dropdown.css('left', '100%');
        }

        return false;

    })
	
});