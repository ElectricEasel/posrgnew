<?php
/**
* @package   ZOO Component
* @file      teaser.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<td>
	<?php echo $this->renderPosition('specification'); ?>
</td>
<td>
	<?php echo $this->renderPosition('title'); ?>
</td>
<td>
	<?php echo $this->renderPosition('links'); ?>
</td>
<td>
	<?php

	ob_start();

	echo $this->renderPosition('description');

	$html = ob_get_clean();

	$html = strip_tags($html);

	$trim = substr($html, 0, 45);
	if(strlen($html) > 45) $trim .= '...';

	echo '<p>' . $trim . '</p>';

	?>
</td>