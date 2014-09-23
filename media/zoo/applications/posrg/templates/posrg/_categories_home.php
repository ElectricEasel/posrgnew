<?php
/**
* @package   ZOO Component
* @file      _categories.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div class="categories <?php if ($categoriestitle) echo 'has-box-title'; ?>">

	<?php if ($categoriestitle) : ?>
	<h1 class="box-title"><span><span><?php echo $categoriestitle; ?></span></span></h1>
	<?php endif; ?>
		<?php

			// init vars
			$i = 0;
			$columns = 4; //$this->params->get('template.categories_cols', 2);			
			reset($this->selected_categories);
			
			// render rows
			while((list($key, $category) = each($this->selected_categories)) || ($i % $columns != 0)) {
				if ($category && !$category->totalItemCount()) continue;
				if ($i % $columns == 0) echo ($i > 0 ? '</div><div class="row">' : '<div class="row first-row">');
				$firstcell = ($i % $columns == 0) ? 'first-cell' : null;
				echo '<div class="width'.intval(100 / $columns).' '.$firstcell.'">'.$this->partial('category_home', compact('category')).'</div>';
				$i++;
			}
			echo '</div>';
		
		?>									
        
</div>