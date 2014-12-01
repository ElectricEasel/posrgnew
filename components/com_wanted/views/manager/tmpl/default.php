<?php defined( '_JEXEC' ) or die;

JHtml::_('behavior.framework');

$count = count($this->items);
$i     = 0;
?>
<form action="<?php echo JRoute::_('index.php?option=com_wanted&view=manager'); ?>" method="post" name='adminForm' id='adminForm' class='gm-form'>
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<input type='hidden' name='task' value='' id='task' />

	<div class='gm-head'>
		<h2 class='left'><?php echo JText::_('Wanted Items Manager') ?></h2>
		<div class='right'>
			<a  href="<?php echo JRoute::_('index.php?option=com_wanted&view=form') ?>"><span><?php echo JText::_('Add Item') ?></span></a>
		</div>
	</div>
    <p id="success-message" style="display:none">Ordering Saved</p>
	<div id='gm-family-list' class='gm-content'>
		<table class="wanted">
			<thead>
				<tr>
					<th><?php echo JText::_('Reorder'); ?></th>
					<th><?php echo JText::_('Title') ?></th>
					<th>
						&nbsp;
					</th>
				</tr>
			</thead>
			<tbody id="sortable">
		<?php
		if ($count) :
			$k = 0;
			$cb = 0;
			foreach ($this->items as $item) :
				$img1    = $item->published ? 'tick.png' : 'publish_x.png';
				$img2    = $item->frontpage ? 'tick.png' : 'publish_x.png';
				$alt     = $item->published ? JText::_('published') : JText::_('published');
				$checked = JHtml::_('grid.id', $i, $item->id);
				?>
				<tr class="<?php echo "row$k"; ?>">
                    <td align="center"  class="handle">
                        <input type="hidden" value="<?php echo $item->id; ?>" name="cid" />
						&bull;
					</td>
                    <td>
                        <a href="<?php echo JRoute::_('index.php?option=com_wanted&view=form&id=' . $item->id) ?>"><?php echo $item->title; ?></a>
                    </td>
					<td>
						<a href="<?php echo JRoute::_('index.php?option=com_wanted&view=form&id=' . $item->id ) ?>"><span>Edit</span></a>
						<a href="<?php echo JRoute::_('index.php?option=com_wanted&task=delete&id=' . $item->id . '&' . JSession::getFormToken() . '=1' ) ?>"><span>Delete</span></a>
					</td>
				</tr>
				<?php $k = 1 - $k;
			endforeach;
		else :
			echo "<td style='text-align: center' colspan='5'>" . JText::_('No Items') . "</td>";
		endif;
		?>
			</tbody>
		</table>
		<div class="gm-family-toolbar wanted-pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	</div>
</form>
