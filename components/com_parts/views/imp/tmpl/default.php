<?php defined('_JEXEC') or die; ?>
<form action="index.php" method='post' name='adminForm' id='adminForm' class='gm-form' enctype="multipart/form-data">
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type='hidden' name='option' value='com_parts' />
	<input type='hidden' name='task' value='save' />
	<div class='gm-head'>
		<h2 class='left'><?php echo JText::_('IMPORT') ?></h2>
	</div>
	<br />
	<br />
	<div class='gm-content'>
		<div class='gm-item'>
			<div class='gm-label'>
				<label><strong>Import File</strong></label>
			</div>
			<br />
			<div class='gm-value'>
				<input type='file' name='file_source' id='file_source' value='' />
			</div>
		</div>
		<br />
		<br />
		<div class="gm-item">
			<div class="gm-label">
				<label><strong>Inventory Import Type</strong></label>
			</div>
			<br />
			<div class="gm-value">
                <select name="inventory_type">
                    <option value="inventory" selected="selected">Inventory</option>
                    <option value="noninventory">Non-Inventory</option>
                </select>
			</div>
		</div>
		<br />
		<br />
	</div>
	<div class='action-container'>
		<button type="submit"><?php echo JText::_('SUBMIT') ?></button>
	</div>
</form>
