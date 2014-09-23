<?php
/**
* @package   ZOO Component
* @file      _items.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div class="items <?php if ($itemstitle) echo 'has-box-title'; ?>">

	<?php if ($itemstitle) : ?>
	<h1 class="box-title"><span><span><?php echo $itemstitle; ?></span></span></h1>
	<?php endif; ?>
    
    <table cellpadding="5" cellspacing="1" border="0" width="622">
        <thead>
            <tr>
                <th width="15%">Part #</th>
                <th width="15%">Manufacturer</th>
                <th width="20%">Category</th>
                <th width="50%">Description</th>
            </tr>
        </thead>
        <tbody>
    <?php
    
        // init vars
        $i = 0;
        $columns = $this->params->get('template.items_cols', 2);
        reset($this->items);
        
        // render rows
        while((list($key, $item) = each($this->items)) || ($i % $columns != 0)) {
            //if ($i % $columns == 0) echo ($i > 0 ? '</div><div class="row">' : '<div class="row first-row">');
            $first = ($i % $columns == 0) ? ' first-item' : null;
			$oddeven = ($i&1) ? ' even' : ' odd';
            echo '<tr class="width'.intval(100 / $columns).$first.$oddeven.'">'.$this->partial('item', compact('item')).'</tr>';
            $i++;
        }
        //echo '</div>';

    ?>
        </tbody>
    </table>
    <?php echo $this->partial('pagination'); ?>									

</div>