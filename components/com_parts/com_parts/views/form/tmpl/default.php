<?php defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';

JRequest::setVar('manufacturer', $this->item->mfc);
JRequest::setVar('part_number', $this->item->part_number);
JRequest::setVar('form_name', 'Quick Quote: Inventory');
JRequest::setVar('inventory_type', $this->item->inventory_type);

?>
<div class="quotebox dropshadow">
    <div class="quotebox-inner">
        <div class="logobox" style="width:100%;border-bottom:2px solid #bdbdbd;margin-bottom:10px;">
            <img src="<?php echo $this->item->image; ?>" /> <br /><br />
        </div>
        <p><strong>Manufacturer:</strong> <?php echo $this->item->mfc; ?></p><br />
        <p><strong>Part:</strong> <?php echo $this->item->part_number; ?></p><br />
        <p><strong>Description:</strong> <?php echo $this->item->des; ?></p>
    </div>
</div>
<div class="quotebox dropshadow">
    <div class="quotebox-inner">
        <h1><span style="color: #0066cc; font-size: 18px; font-weight: bold;">Quick Quote:</span></h1>
        <br />
        <div class="form_item">
            <div style="width:100%;border-bottom:2px solid #bdbdbd;margin-bottom:10px;" class="form_element cf_heading">
                <img src="/images/quickquote.png" style="float:right;padding:0 10px 10px 20px;position:relative;top:-20px" />
                <p style="font-size:14px;font-weight:normal;margin:0;line-height:18px;">POSRG prides itself on customer service. Please fill out the form below and a POSRG customer services representative will be in touch with you right away.</p>
                <br />
                <p style="font-size:14px;font-weight:bold">Fill out the form below and we'll get right back with you.</p>
                <br />
            </div>
        </div>
        <br />
        <div class="form_item">
            <div class="form_element cf_heading">
                <p style="float:left;font-size:12px;">Current Time: <?php echo date("g:ia - m/d/y") ?></p>
                <p style="float:right;font-size:12px;margin-right:28px"><span style="color:red">*</span> required fields</p>
                <div class="clear"></div>
            </div>
        </div>
        <br />
        <div class="quotebox-form-wrap">
            <?php echo RSFormProHelper::displayForm(3); ?>
        </div>
    </div>
</div>
