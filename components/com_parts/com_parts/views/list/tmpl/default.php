<?php defined( '_JEXEC' ) or die;

$count = count($this->data);
$i     = 0;
$resetUrl = JRoute::_('index.php?option=com_parts&view=list');

?>
<h2 class="componentheading">
	<?php echo JText::_('PART LIST') ?>
</h2>
<div class="contentpaneopen">
	<div class="contentpane">
		<form name="adminform" id="adminform" action="<?php echo JRoute::_('index.php?option=com_parts&view=list'); ?>" method="get">
			<table class="gm-search" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th class="nopad"><?php echo JText::_('MANUFACTURER') ?></th>
						<th><?php echo JText::_('KEYWORD') ?></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="nopad"><?php echo $this->mfcSelectList ?></td>
						<td>
							<input type="hidden" class="" name="part_number" id="part_number" placeholder="Part # or Keword" />
							<input type="text" class="" name="keyword" id="keyword" value="<?php echo $this->state->get('filter.keyword'); ?>" />
						</td>
						<td>
							<input type="submit" value="" class="seachbutton" style="background:url(/components/com_parts/assets/images/search.png);width:95px;height:33px;cursor:pointer" />&nbsp;
							<input type="submit" value="" class="seachbutton" onclick="document.location.href='<?php echo $resetUrl; ?>'; return false;" style="background:url(/components/com_parts/assets/images/reset.png);width:95px;height:33px;cursor:pointer" />
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<script type="text/javascript">
		// <![CDATA[
		jQuery(document).ready(function ($) {
			$('#mfc').change(function () {
				var base = $(this);
				document.location.href = "<?php echo $resetUrl; ?>?mfc=" + base.val();
			});
		});
		// ]]>
		</script>
	</div>
	<div id="gm-part-list" class="gm-content">
		<?php if ($count) : ?>
		<table id="gm-table-part-list" class="intro" width="704px" cellpadding="5" cellspacing="0" border="0">
			<thead>
				<tr>
					<td nowrap="nowrap" width="70px" class="sectiontableheader"><?php echo JText::_('BRAND') ?></td>
					<td nowrap="nowrap" width="190px" class="sectiontableheader"><?php echo JText::_('PART NUMBER') ?></td>
					<td nowrap="nowrap" width="260px" class="sectiontableheader"><?php echo JText::_('DESCRIPTION') ?></td>
					<td nowrap="nowrap" width="40px" class="sectiontableheader"><?php echo JText::_('COND') ?></td>
					<td nowrap="nowrap" width="34px" class="sectiontableheader"><?php echo JText::_('QTY') ?></td>
					<td nowrap="nowrap" width="40px" class="sectiontableheader"><?php echo JText::_('PRICE') ?></td>
				</tr>
			</thead>
			<tbody>
			<?php
			$j = 0;
			foreach ($this->data as $item)
			{
				foreach($item as $key => $value)
				{
					$item->$key = JFilterOutput::ampReplace($value);
				}

				$j++;
				$item->url = JRoute::_('index.php?option=com_parts&view=form&id=' . $item->id);
				?>
				<tr class="sectiontableentry<?php echo $j; ?>">
					<td class="first"><?php echo $item->mfc; ?></td>
					<td><?php echo $item->part_number; ?></td>
					<td><?php echo $item->des; ?></td>
					<td><?php echo $item->new; ?></td>
					<td><?php
                        // Just show blank if count is 0
                        echo $item->physical_count ?: ''; ?></td>
					<td class="last"><a class="gm-quote" href="<?php echo $item->url ?>">Quote</a></td>
				</tr>
			<?php if ($j == 2) $j = 0;
			}	?>
			</tbody>
		</table>
		<?php
		else :
			echo '<div class="no-results">' . JText::_('NO ITEM') . '</div>';
		endif; ?>
		<div class="gm-part-toolbar">
			<?php echo str_replace('y?limitstart=0', 'y', $this->pagination->getPagesLinks()); ?>
		</div>
	</div>
</div>
