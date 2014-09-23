<?php
/**
* @package   ZOO Component
* @file      _mysubmissions.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$this->app->document->addStylesheet('media:zoo/assets/css/submission.css');
$this->app->document->addScript('media:zoo/assets/js/submission.js');

$mysubmissions_link = $this->app->route->mysubmissions($this->submission);

?>
<div class="toolbar">
	<div class="submission-add">
		<div class="trigger" title="<?php echo JText::_('Add Item'); ?>"><?php echo JText::_('Add Item'); ?></div>
		<div class="links">
		<?php foreach($this->types as $id => $type) : ?>
			<?php $add_hash = $this->app->submission->getSubmissionHash($this->submission->id, $id); ?>
			<?php $add_link = $this->app->route->submission($this->submission, $id, $add_hash, null, 'mysubmissions'); ?>
			<div class="add-link">
				<a href="<?php echo JRoute::_($add_link); ?>" title="<?php echo sprintf(JText::_('Add %s'), $type->name); ?>"><?php echo $type->name; ?></a>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
	
	<?php if (isset($this->lists['select_type'])) : ?>
	<form id="submission-filter" action="<?php echo JRoute::_($mysubmissions_link); ?>" method="post" name="adminForm" accept-charset="utf-8">
		<?php echo $this->lists['select_type']; ?>
	</form>
	<?php endif; ?>
	
</div>

<?php

if (count($this->items)) :

	$all_items = array();
	$i=0;
	foreach ($this->items as $id => $item) :
		$this_item .= '<li>
			<div class="header">';	
				if ($this->submission->isInTrustedMode()) :
					$this_item .= '<a href="'.$this->app->link(array('controller' => 'submission', 'submission_id' => $this->submission->id, 'task' => 'remove', 'item_id' => $id)).'" title="'.JText::_('Delete Item').'" class="item-icon delete-item"></a>';
				endif;
					$edit_hash = $this->app->submission->getSubmissionHash($this->submission->id, $item->type, $id);
					$edit_link = $this->app->route->submission($this->submission, $item->type, $edit_hash, $id, 'mysubmissions');
				$this_item .= '<a href="'.JRoute::_($edit_link).'" title="'.JText::_('Edit Item').'" class="item-icon edit-item"></a>';
				$this_item .= '<h3 class="toggler"><a href="'.JRoute::_($edit_link).'" title="'.JText::_('Edit Item').'">'.$item->name.'</a></h3>
			 </div>
		</li>';
		$all_items[$item->getType()->name][$i] = $this_item;
		unset($this_item);
		$i++;
	endforeach;
	
	foreach($all_items as $type => $entries)
	{
		echo '<h4>'.$type.'s</h4>';
		echo '<ul class="submissions">';
		foreach($entries as $entry)
		{
			echo $entry;
		}
		echo '</ul>';
	}
	
else :
	$type = $this->filter_type; ?>
	<p class="no-submissions"><?php echo sprintf(JText::_('You have not submitted any %s items yet.'), $this->filter_type); ?></p>

<?php endif; ?>

<div class="pagination">
	<?php $pagination_link = !empty($this->filter_type) ? $mysubmissions_link . '&filter_type=' . $this->filter_type : $mysubmissions_link; ?>
	<?php echo $this->pagination->render($pagination_link); ?>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$('#yoo-zoo').SubmissionMysubmissions({ msgDelete: '<?php echo JText::_('Are you sure you want to delete this submission?'); ?>' });
	});
</script>