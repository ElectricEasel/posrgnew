<?php defined( '_JEXEC' ) or die;

JHtml::_('behavior.framework');

$count = count($this->items);
$i     = 0;
?>
<form action="<?php echo JRoute::_('index.php?option=com_product&view=manager'); ?>" method="post" name='adminForm' id='adminForm' class='gm-form'>
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<input type='hidden' name='task' value='' id='task' />

	<div class='gm-head'>
		<h2 class='left'><?php echo JText::_('GM_PRODUCT_MANAGER_HEAD') ?></h2>
		<div class='right'>
			<a  href="<?php echo JRoute::_('index.php?option=com_product&view=form') ?>"><span><?php echo JText::_('Add Product') ?></span></a>
		</div>
	</div>
	<div class='item'>
		<label><?php echo JText::_('Product name') ?></label><br/>
		<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="gm-input" onchange="document.adminForm.submit();" />
	</div>
	<div id='gm-family-list' class='gm-content'>
		<table class="adminlist">
			<thead>
				<tr>
					<th width="50" ></th>
					<th width="150">
						<?php echo JHtml::_('grid.sort', JText::_('GM_PRODUCT_MANAGER_NAME'), 'product_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th>
						<?php echo JHtml::_('grid.sort', JText::_('GM_PRODUCT_MANAGER_PRICE'), 'price', $this->lists['order_Dir'], $this->lists['order'] ); ?>
					</th>
					<th>
						<?php echo JText::_('GM_PRODUCT_MANAGER_DES'); ?>
					</th>
					<th>
						<?php echo JText::_('GM_PRODUCT_MANAGER_FONTEND') ?>
					</th>
					<th>
						<?php echo JText::_('GM_PRODUCT_MANAGER_PUBLISH') ?>
					</th>
					<th width="60">
						<?php echo JHtml::_('grid.sort', JText::_('GM_PRODUCT_FORM_ORDER'), 'ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?>
						<?php echo $this->order($this->items); ?>
					</th>
					<th>
						&nbsp;
					</th>
				</tr>
			</thead>
			<tbody>
		<?php
		if ($count) :
			$k = 0;
			$cb = 0;
			foreach ($this->items as $item) :
				$img	= $this->getThumb("components/com_product/assets/upload/default.gif", 50, 50);

				if(JFile::exists(JPATH_COMPONENT . '/assets/upload/' . $item->image ))
				{
					$img = $this->getThumb("components/com_product/assets/upload/" . $item->image, 50, 50);
				}

				$img1    = $item->published ? 'tick.png' : 'publish_x.png';
				$img2    = $item->frontpage ? 'tick.png' : 'publish_x.png';
				$alt     = $item->published ? JText::_('published') : JText::_('published');
				$checked = JHtml::_('grid.id', $i, $item->id);
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td>
						<div class='gm-image-container left size-min'>
							<img src='<?php echo $img ?>' class='gm-image-size size-min' alt="<?php echo $item->product_name; ?>" />
						</div>
						<input name='cid[]' id='cb<?php echo $cb++ ?>' value="<?php echo $item->id ?>" type='hidden' />
					</td>
					<td align="center">
						<a href="<?php echo JRoute::_('index.php?option=com_product&view=form&id=' . $item->id) ?>"><?php echo $item->product_name; ?></a>
					</td>
					<td>
						<?php echo number_format($item->price, 2)  ?> $
					</td>
					<td align="center">
						<?php echo $item->product_des; ?>
					</td>
					<td align="center">
						<img src="components/com_product/assets/images/<?php echo $img2;?>" width="16" height="16" border="0" alt="" />
					</td>
					<td>
						<a href="<?php echo JRoute::_('index.php?option=com_product&id=' . $item->id. '&task=publish&' . JSession::getFormToken() . '=1') ?>" >
							<img src="components/com_product/assets/images/<?php echo $img1;?>" width="16" height="16" border="0" alt="<?php echo $alt; ?>" />
						</a>
					</td>
					<td align="center">
						<input type="text" name="order[]" size="5" value="<?php echo $item->ordering; ?>"  class="text_area" style="text-align: center" />
					</td>
					<td>
						<a href="<?php echo JRoute::_('index.php?option=com_product&view=form&id=' . $item->id ) ?>"><span>Edit</span></a>
						<a href="<?php echo JRoute::_('index.php?option=com_product&task=delete&id=' . $item->id . '&' . JSession::getFormToken() . '=1' ) ?>"><span>Delete</span></a>
					</td>
				</tr>
				<?php $k = 1 - $k;
			endforeach;
		else :
			echo "<td style='text-align: center' colspan='5'>" . JText::_('GM_PRODUCT_LIST_NO_ITEM') . "</td>";
		endif;
		?>
			</tbody>
		</table>
		<div class="gm-family-toolbar">
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	</div>
</form>
