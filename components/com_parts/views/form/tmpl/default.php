<?php defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';

JRequest::setVar('manufacturer', $this->item->mfc);
JRequest::setVar('part_number', $this->item->part_number);
JRequest::setVar('form_name', 'Quick Quote: Inventory');
JRequest::setVar('inventory_type', $this->item->inventory_type);

$image = $this->item->image ? $this->item->image : '/images/stories/brands/posrg_search.png';
$mfc = $this->item->mfc ? $this->item->mfc : '';
$part_number = $this->item->part_number ? $this->item->part_number : '';
$des = $this->item->des ? $this->item->des : '';
?>
<div class="quotebox dropshadow">
    <div class="quotebox-inner">
        <div class="logobox">
            <img src="<?php echo $image; ?>" /> <br /><br />
        </div>
        <p><strong>Manufacturer:</strong> <?php echo $mfc; ?></p>
        <p><strong>Part:</strong> <?php echo $part_number; ?></p>
        <p><strong>Description:</strong> <?php echo $des; ?></p>
    </div>
</div>
<div class="quotebox dropshadow">
    <div class="quotebox-inner">
        <h2>Quick Quote:</h2>
        <div class="form_item">
            <div class="form_element cf_heading">
                <img src="/templates/posrg/images/quickquote.png" style="float:right;padding:0 10px 10px 20px;position:relative;top:-20px" />
                <p>POSRG prides itself on customer service. Please fill out the form below and a POSRG customer services representative will be in touch with you right away.</p>
                <p><strong>Fill out the form below and we'll get right back with you.</strong></p>
            </div>
        </div>
        <div class="form_item">
            <div class="form_element cf_heading">
                <p class="pull-left">Current Time: <?php echo date("g:ia - m/d/y") ?></p>
                <p class="pull-right"><span>*</span> required fields</p>
                <div class="clear"></div>
            </div>
        </div>
        <div class="quotebox-form-wrap">
            <?php echo RSFormProHelper::displayForm(1); ?>
        </div>
    </div>
</div>
