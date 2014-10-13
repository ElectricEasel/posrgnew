<?php defined( '_JEXEC' ) or die;

$count	= count($this->items);
$i		= 0;
?>
<div id="gm-family-grid" class="gm-content">
	<h2 class="componentheading"><?php echo JText::_('GM_PRODUCT_PRODUCT_LIST') ?></h2>
	<?php
	$i=0;
	if ($count) :
		foreach ($this->items as $item) :
			$detailUrl	= JRoute::_('index.php?option=com_product&view=detail&id='.$item->id);
			$buyUrl		= JRoute::_('index.php?option=com_product&view=buy&id='.$item->id);
			$img		= $this->getThumb("components/com_product/assets/upload/default.gif", 100, 125);
			$lightbox	= JUri::base()."components/com_product/assets/upload/default.gif";

			if (JFile::exists(JPATH_COMPONENT.'/assets/upload/'.$item->image))
			{
				$img =  $this->getThumb("components/com_product/assets/upload/" . $item->image, 100, 125);
				$lightbox = JUri::base()."components/com_product/assets/upload/" . $item->image;
			}

			$action	= JUri::base() . 'templates/family/images/btn_view_profile.png';
			?>
	<div class="gm-box-r">
		<div class="gm-box-t">
			<div class="gm-box-b">
				<div class="gm-item">
					<a href="<?php echo $lightbox; ?>" class="fancybox gm-enlarge">
						<?php echo JText::_('GM_PRODUCT_LIGHTBOX')?>

					</a>
					<div class="gm-image-container size-med">
						<a href="<?php echo $lightbox; ?>" class="fancybox" title="">
							<img src="<?php echo $img ?>" class="gm-image-size size-med" alt="<?php echo $item->product_name ?>" />
						</a>
					</div>
					<div>
						<h4 class="gm-name gm-ptitle"><?php echo $item->product_name ?></h4>
						<div class="gm-description"><?php echo $item->product_des ?></div>
						<div>Price: <span class="gm-price">$<?php echo number_format($item->price, 2) ?></span></div>
						<a href="<?php echo $buyUrl; ?>" title="<?php echo $item->product_name; ?>" class="buynow">
							<?php echo JText::_('Buy Now') ?>

						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		$i++;
		if($i%3 == 0) echo '<div class="clear"></div>';
		endforeach;
	else :
		echo '<div style="text-align: center">'.JText::_('GM_PRODUCT_LIST_NO_ITEM').'</div>';
	endif; ?>

</div>