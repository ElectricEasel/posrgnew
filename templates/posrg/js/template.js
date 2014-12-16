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
    $('.chzn-select').chosen();
    $('#state').chosen();

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
    var hasToggled = false;

    $('.navbar-toggle').click(function () {
        if (!hasToggled) {
            mobile_parent.each(function () {
                var sub_dropdown_id = $(this).prev().attr('href');
                var sub_dropdown = $(sub_dropdown_id);
                $(this).after(sub_dropdown);
            });
            hasToggled = true;
        }
    });

    mobile_parent.click(function(){
        var sub_dropdown_id = $(this).prev().attr('href');
        var sub_dropdown = $(sub_dropdown_id);
        var target = $(this);

        $(this).after(sub_dropdown);

        if (!$(this).hasClass('selected')) {
            mobile_parent.each(function(){
                if (!target.parent().parent().hasClass('sub-open')) {
                    $(this).removeClass('selected');
                    $(this).removeClass('selected-inner');
                    $(this).next('ul').removeClass('sub-open');
                }
                target.parent().siblings().each(function(){
                    $(this).children().removeClass('selected-inner');
                    $(this).children().next('ul').removeClass('sub-open');
                });
            });
        }

        sub_dropdown.toggleClass('sub-open');
        if (!$(this).parent().hasClass('dropdown-submenu')) {
            $(this).toggleClass('selected');
        }
        else {
            $(this).toggleClass('selected-inner');
        }

        return false;

    })
	
});