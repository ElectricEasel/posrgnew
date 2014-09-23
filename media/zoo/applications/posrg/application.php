<?php
/**
* @package   ZOO Component
* @file      application.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class PosrgApplication extends Application {

	public function __construct()
	{
		parent::__construct();
		
		$zoo = App::getInstance('zoo');
		$zoo->path->register(dirname(__FILE__) . '/classes', 'classes');
		$zoo->loader->register('ItemRenderer', 'classes:itemrenderer.php');
	}
}