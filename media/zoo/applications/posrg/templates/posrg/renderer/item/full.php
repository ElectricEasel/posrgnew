<?php
/**
* @package   ZOO Component
* @file      full.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * getTopLevelCategory function.
 *
 * @access public
 * @param mixed $item
 * @return void
 */
function getTopLevelCategory($item)
{
	$app = App::getInstance('zoo');
	$item_cat_ids = $app->category->getItemsRelatedCategoryIds($item->id);
	$par_cat = $app->table->category->get($item_cat_ids[0]);
	do {
		$par_cat = $par_cat->_parent;
	} while ($par_cat->_parent->id > 0);

	return $par_cat;
}

$modelNumber = $item->getElement('f64a39d0-9b8f-4a84-ac90-19744a889cdb');
if (is_object($modelNumber))
{
	$modelNumber = $modelNumber->getElementData()->get('value');
}
else
{
	$modelNumber = null;
}
?>

<?php if ($this->checkPosition('top')) : ?>
<div class="pos-top">

	<div class="box-t1">
		<div class="box-t2">
			<div class="box-t3"></div>
		</div>
	</div>

	<div class="box-1">
		<?php echo $this->renderPosition('top', array('style' => 'block')); ?>
	</div>

	<div class="box-b1">
		<div class="box-b2">
			<div class="box-b3"></div>
		</div>
	</div>

</div>
<?php endif; ?>

<div class="floatbox">

	<div class="box-t1">
		<div class="box-t2">
			<div class="box-t3"></div>
		</div>
	</div>

	<div class="box-1">

        <?php
		$posrg_item_parent_cat = $this->app->category->getItemsRelatedCategoryIds($this->_item->id);
		$mycat = $this->app->table->category->get($posrg_item_parent_cat[0]);
		do {
			$mycat = $mycat->_parent;
		} while ($mycat->_parent->id > 0);

		$myimage = $mycat->getImage('content.image');

		if($myimage != null)
		{
			?>
            <img class="head_image" src="<?php echo $myimage['src']; ?>" title="<?php echo $mycat->name; ?>" alt="<?php echo $mycat->name; ?>" <?php echo $myimage['width_height']; ?>/>
            <?php
		}
		?>

		<?php if ($this->checkPosition('media')) : ?>
		<div class="pos-media <?php echo 'media-'.$view->params->get('template.item_media_alignment'); ?>">
			<?php echo $this->renderPosition('media', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>

		<?php if ($this->checkPosition('title')) : ?>
		<h1 class="pos-title"><?php echo $this->renderPosition('title'); ?></h1>
		<?php endif; ?>

		<?php if ($this->checkPosition('meta')) : ?>
		<ul class="pos-meta">
			<?php echo $this->renderPosition('meta', array('style' => 'list')); ?>
		</ul>
		<?php endif; ?>

		<?php if ($this->checkPosition('buttons')) : ?>
		<div class="pos-buttons">
			<?php echo $this->renderPosition('buttons', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>

		<?php if ($this->checkPosition('description')) : ?>
		<div class="pos-description">
			<?php echo $this->renderPosition('description', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>

		<?php if ($this->checkPosition('features')) : ?>
		<div class="pos-features">
			<?php echo $this->renderPosition('features', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>

		<div style="clear:both"></div>
		<?php if ($this->checkPosition('specification')) : ?>
		<div class="pos-specification">
			<ul>
				<?php echo $this->renderPosition('specification', array('style' => 'list')); ?>
			</ul>
		</div>
		<?php endif; ?>
		<a name="quick-quote">&nbsp;</a>
		<h3>Online Quote &nbsp;&nbsp;&nbsp;<span style="color:red">* <span style="color:white">required fields</span></span></h3>
		<?php
		require_once JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';

		JRequest::setVar('manufacturer', getTopLevelCategory($this->_item)->name);
		JRequest::setVar('part_number', $modelNumber);

		echo RSFormProHelper::displayForm(3); ?>

		<?php if ($this->checkPosition('bottom')) : ?>
		<div class="pos-bottom">
			<?php echo $this->renderPosition('bottom', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>

		<?php if ($this->checkPosition('related')) : ?>
		<div class="pos-related">
			<?php echo $this->renderPosition('related', array('style' => 'block')); ?>
		</div>
		<?php endif; ?>

	</div>

	<div class="box-b1">
		<div class="box-b2">
			<div class="box-b3"></div>
		</div>
	</div>

</div>