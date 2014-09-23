<?php
/**
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.framework');
/*
JHtml::script('modules/mod_bootstrap_article_slideshow/js/jquery.js');
JHtml::script('modules/mod_bootstrap_article_slideshow/js/carousel.js');
*/
//JHtml::stylesheet('modules/mod_bootstrap_article_slideshow/css/carousel.css', false, true, false);
JHtml::stylesheet('modules/mod_bootstrap_article_slideshow/css/carousel.css');

?>
<!--
<script>
!function ($) {

  $(function(){
    $('#myCarousel').carousel();
   });
}(window.jQuery)   
</script>
-->
<div class="newsflash<?php echo $moduleclass_sfx; ?>">
	<div id="myCarousel" class="carousel slide">
	    <div class="carousel-inner">
	    	<?php for ($i=0;$i<count($list);$i++){?>
	    		<?php if ($list[$i]->images->image_intro){?>
			        <div class="item <?php echo ($i == 0) ? 'active' : '' ?>">
	                	<a href="<?php echo $list[$i]->link ?>">
				        	<img class="carousel-image" src="<?php echo $list[$i]->images->image_intro?>" border="0" alt="<?php echo htmlentities($list[$i]->title); ?>" />
				        </a>
			            <div class="carousel-caption">
			                <h4>
			                	<a href="<?php echo $list[$i]->link ?>">
			                		<?php echo $list[$i]->title?>
			                	</a>
			                </h4>
			                <p><?php echo $list[$i]->introtext ?></p>
			            </div>
			        </div>
		        <?php } ?>
	        <?php } ?>
	    </div>
    	<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a> <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
    </div>
</div>
