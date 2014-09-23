/**
 * @package   Noble Joomla! 3.0 Template
 * @version   1.0
 * @author    7Studio Tomasz Herudzinski http://www.7studio.eu
 * @copyright Copyrights (C) 2009 - 2013 7Studio Tomasz Herudzinski
 * @license   ThemeForest Regular License - http://themeforest.net/licenses/regular_extended
**/

jQuery(document).ready(function(){
	jQuery("#totop").hide();
		jQuery(window).scroll(function(){
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#totop').fadeIn();
			} else {
				jQuery('#totop').fadeOut();
			}
		});
		
		jQuery('#totop').click(function(){
			jQuery("html, body").animate({ scrollTop: 0 }, 660, 'easeInOutExpo');
			return false;
		});

});