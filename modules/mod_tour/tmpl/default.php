<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$template_path = '/templates/posrg';
$mod_path = '/modules/mod_tour/';

$doc = JFactory::getDocument();

$doc->addStyleSheet($mod_path.'css/base/advanced-slider-base.css');
$doc->addStyleSheet($mod_path.'css/slider-skins/glossy-square/blue/glossy-square-blue.css');

$doc->addScript($mod_path.'js/jquery.easing.1.3.min.js');
$doc->addScript($mod_path.'js/jquery.advancedSlider.min.js');
$doc->addScriptDeclaration("
// <![CDATA[
jQuery(document).ready(function($){
    $('#tour-slider').advancedSlider({
       width: 550,
	   height: 340,
	   skin: 'glossy-square-blue',
	   effectType: 'fade',
	   lightbox: false,
	   thumbnailLightboxIcon: true,
	   thumbnailLightboxIconToggle: true,
	   slideButtons: false,
	   thumbnailType: 'scroller',
	   maximumVisibleThumbnails: 4,
	   thumbnailButtons: true,
	   thumbnailOrientation: 'vertical',
	   captionToggle: false, 
	   captionSize: 35,
	   captionHideEffect: 'fade',
	   captionShowEffect: 'fade',
	   thumbnailWidth: 75,
	   thumbnailHeight: 50,
	   slideArrowsToggle: false,
	   captionShowEffectDuration: 200,
	   captionHideEffectDuration: 200,
	   preloadNearbyImages: true
		});
	});
// ]]>
");
?>
<h2 id="tour-heading">Facility Tour</h2>
    <div class="advanced-slider" id="tour-slider">
<!--[if IE]><script type="text/javascript" src="js/excanvas.compiled.js"></script><![endif]-->




	<ul class="slides">
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/team.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/team-th.jpg"/>
		    <div class="caption">Power Up With The POSRG Team</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/canadian-office.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/canadian-office.jpg"/>
		    <div class="caption">The POSRG Canada Team</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/register.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/register.jpg"/>
		    <div class="caption">Antique Register in Entrance at POSRG</div>
	    </li>
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/production-meeting.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/production-meeting.jpg"/>
		    <div class="caption">Production Meeting</div>
	    </li>
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/market-trends.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/market-trends.jpg"/>
		    <div class="caption">Market Trends</div>
	    </li>
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/location.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/location.jpg"/>
		    <div class="caption">Our New Office</div>
	    </li>
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/new-location.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/new-location.jpg"/>
		    <div class="caption">Welcome to POSRG</div>
	    </li>
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/front-reception.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/front-reception.jpg"/>
		    <div class="caption">Front Reception</div>
	    </li>
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/sales-pit.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/sales-pit.jpg"/>
		    <div class="caption">Sales Pit</div>
	    </li>
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/trucking.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/trucking.jpg"/>
		    <div class="caption">Trucking</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/full-system-implementation.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/full-system-implementation.jpg"/>
		    <div class="caption">Full System Implementation</div>
	    </li>
	    <!--
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/receiving-breakdown.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/receiving-breakdown.jpg"/>
		    <div class="caption">Receiving and Breakdown</div>
	    </li>
	    -->
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/board-repair.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/board-repair.jpg"/>
		    <div class="caption">Board Level Repairs</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/body-work.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/body-work.jpg"/>
		    <div class="caption">Body Work</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/plastic-repair.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/plastic-repair.jpg"/>
		    <div class="caption">Plastic Repair</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/paint-booths.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/paint-booths.jpg"/>
		    <div class="caption">Paint Booths</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/new-downdraft.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/new-downdraft.jpg"/>
		    <div class="caption">Down draft table</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/detail-center.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/detail-center.jpg"/>
		    <div class="caption">Detail Center</div>
	    </li>
<li class="slide" data-image="<?php echo $template_path; ?>/images/tour/detailing.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/detailing.jpg"/>
		    <div class="caption">Detailing Line</div>
	    </li>
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/paint-curing.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/paint-curing.jpg"/>
		    <div class="caption">Paint Curing Area</div>
	    </li>	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/down-draft-table.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/down-draft-table.jpg"/>
		    <div class="caption">Down Draft Table</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/sonic-tubs.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/sonic-tubs.jpg"/>
		    <div class="caption">Sonic Tubs</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/imaging-station.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/imaging-station.jpg"/>
		    <div class="caption">Imaging Station</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/lcd-repair.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/lcd-repair.jpg"/>
		    <div class="caption">LCD Repair</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/printer-repair.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/printer-repair.jpg"/>
		    <div class="caption">Printer Repair</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/packaging.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/packaging.jpg"/>
		    <div class="caption">Packaging</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/tube-replacement.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/tube-replacement.jpg"/>
		    <div class="caption">Tube Replacement</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/production-line.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/production-line.jpg"/>
		    <div class="caption">Production Line</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/parts-stock.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/parts-stock.jpg"/>
		    <div class="caption">Parts Stock</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/peripheral-warehousing.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/peripheral-warehousing.jpg"/>
		    <div class="caption">Peripheral Warehousing</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/warehousing-with-crown.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/warehousing-with-crown.jpg"/>
		    <div class="caption">Warehousing with Crown</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/touch-terminal-inventory.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/touch-terminal-inventory.jpg"/>
		    <div class="caption">Touch Terminal Inventory</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/data-collection.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/data-collection.jpg"/>
		    <div class="caption">Data Collection</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/parts-inventory.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/parts-inventory.jpg"/>
		    <div class="caption">Parts Inventory Control</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/pretest-audit.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/pretest-audit.jpg"/>
		    <div class="caption">Pretest and Audit</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/pre-boxing.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/pre-boxing.jpg"/>
		    <div class="caption">Pre Boxing</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/staging.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/staging.jpg"/>
		    <div class="caption">Staging for Technical Center</div>
	    </li>
	    <!--
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/customer-install.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/customer-install.jpg"/>
		    <div class="caption">Customer Install</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/finished-install.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/finished-install.jpg"/>
		    <div class="caption">Finished Customer Install</div>
	    </li>
	    -->
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/customer-install2.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/customer-install2.jpg"/>
		    <div class="caption">Customer Install</div>
	    </li>
	    <!-- newest -->
	    
	    
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/cleaning.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/cleaning.jpg"/>
		    <div class="caption">Parts Cleaning</div>
	    </li>
	    
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/compactor.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/compactor.jpg"/>
		    <div class="caption">Compactor</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/recylced-materials.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/recylced-materials.jpg"/>
		    <div class="caption">Compactor</div>
	    </li>
	    
	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/data-destruction.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/data-destruction.jpg"/>
		    <div class="caption">Data Destruction</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/e-waste.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/e-waste.jpg"/>
		    <div class="caption">E-Waste</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/custom-packaging.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/custom-packaging.jpg"/>
		    <div class="caption">Custom Packaging</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/recycling-asset-disposal.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/recycling-asset-disposal.jpg"/>
		    <div class="caption">Recycling and Asset Disposal</div>
	    </li>

	    <li class="slide" data-image="<?php echo $template_path; ?>/images/tour/shipping.jpg">
		    <img class="thumbnail" src="<?php echo $template_path; ?>/images/tour/thumbnails/shipping.jpg"/>
		    <div class="caption">Shipping</div>
	    </li>

	</ul>

</div>