<?php
/**
* @package   ZOO Component
* @file      link.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/*
   Class: ElementButtons
       The link element class
*/
class ElementButtons extends Element
{
	/*
		Function: hasValue
			Checks if the element's value is set.

	   Parameters:
			$params - render parameter

		Returns:
			Boolean - true, on success
	*/
	public function hasValue($params = array())
	{
		return true;
	}

	/*
		Function: render
			Renders the element.

	   Parameters:
            $params - render parameter

		Returns:
			String - html
	*/
	public function render($params = array())
	{
		$url = '#quick-quote';

		$return = '
			<a class="blue_btn" href="' . $url . '" alt="' . $this->_item->name . '">Quick Quote</a>
			<a class="green_btn" href="javascript:void(window.open(\'http://www.posrg.com/chat/chat.php\',\'\',\'width=590,height=580,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes\'))">Live Chat</a>
		';

		return $return;

	}

	public function edit()
	{
		return null;
	}
}