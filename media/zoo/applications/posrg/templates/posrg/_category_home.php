<?php
/**
* @package   ZOO Component
* @file      _category.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div class="category">
<?php if ($category) : ?>

	<?php $link = $this->app->route->category($category); ?>

	<?php if (($image = $category->getImage('content.teaser_image'))) : ?>
	<a class="teaser-image" href="<?php echo $link; ?>" title="<?php echo $category->name; ?>">
		<img src="<?php echo $image['src']; ?>" title="<?php echo $category->name; ?>" alt="<?php echo $category->name; ?>" <?php echo $image['width_height']; ?>/>
	</a>
	<?php endif; ?>

<?php endif; ?>
</div>