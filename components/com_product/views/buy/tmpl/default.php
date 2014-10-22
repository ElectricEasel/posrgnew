<?php defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';

// JRequest::setVar('manufacturer', $this->item->mfc);
JRequest::setVar('part_number', $this->item->product_name);
JRequest::setVar('form_name', 'Buy Now: Specials');
?>
<div id='gm-family-detail' class='gm-content'>
	<div class='gm-head' style="margin-bottom:0;">
		<h2>Current Specials</h2>
	</div>
	<div class='gm-item-form'>
		<img class="pull-left" src="<?php echo $this->image; ?>" alt="<?php echo $this->item->product_name; ?>" />
		<h4 class="spec-name"><?php echo $this->item->product_name; ?></h4>
		<p class="product-desc"><?php echo $this->item->product_des; ?></p>
		<p class="price">Price: <span class="gm-price">$<?php echo  number_format($this->item->price, 2);  ?></span></p>
		<p class="contact-text">Fill out the form below and one of our representatives will get right back to you. Or call us toll free at 866-462-1005</p>
		<div class="clear"></div>
	</div>
	<span class="required-key"><span style="color:red;">*</span> required fields</span>
	<div class="specials-form-wrap">
		<?php echo RSFormProHelper::displayForm(1); ?>
	</div>
</div>
