<?php defined( "_JEXEC" ) or die;

JHtml::_('behavior.formvalidation');
?>
<div class="gm-head">
	<h2><?php echo JText::_("Add Wanted Item") ?></h2>
</div>
<div id="gm-family-form" class="gm-content">
	<form name="gm_form_family" id="gm_form_family" action="<?php echo JRoute::_("index.php?option=com_wanted&task=save") ?>" method="post"  class="form-validate gm-form">

		<div class="item">
			<div class="label">
				<label for="wanted_title"><?php echo JText::_('TITLE') ?> <span class="req" >*</span></label>
			</div>
			<div class="value">
				<input name="title" value="<?php echo $this->item->title ?>" id="wanted_title" class="gm-input required" type="text" maxlength="50" />
			</div>
		</div>

		<div class="action-container">
			<span class="req left"><?php echo JText::_('* REQUIRED') ?></span>

			<button id="cancel" type="button" ><?php echo JText::_('Cancel') ?></button>
			<button type="submit" class="validate" id="save_fm"><?php echo JText::_('Save') ?></button>
		</div>
		<input type="hidden" name="id"	value="<?php echo $this->item->id ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
