<?php
/**
 * @package     Joostrap.Template
 * @subpackage  Field
 *
 * @copyright   Copyright (C) 2005 - 2014 Joostrap. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Field to load a specific asset file from template folder
 *
 * @package     Joostrap
 * @subpackage  Field
 * @since       1.0
 */
class JFormFieldTplasset extends JFormField
{
	protected $type = 'Tplasset';

	/**
	 * Method to get the field input markup for a generic list.
	 * Use the multiple attribute to enable multiselect.
	 *
	 * @return  string  The field input markup.
	 */
	protected function getInput()
	{
		// Get the relative path to the assets to avoid tpl dependencies
		$relativePath = trim(str_replace(JPATH_SITE, '', dirname(__DIR__)), '/');
		$tplUrl = JUri::root() . $relativePath;

		$asset = isset($this->element['asset']) ? $this->element['asset'] : null;

		if (!empty($asset))
		{
			$extension = pathinfo($asset, PATHINFO_EXTENSION);

			if (!empty($extension))
			{
				$filePath = JPATH_SITE . '/' . $relativePath . '/' . $extension . '/' . $asset;
				$versionPreffix = version_compare(JVERSION, '3.0', '<') ? '.j25' : '.j3';
				$versionedFile = str_replace('.' . $extension, $versionPreffix . '.' . $extension, $filePath);

				if (file_exists($versionedFile))
				{
					$asset = str_replace('.' . $extension, $versionPreffix . '.' . $extension, $asset);
				}

				$doc = JFactory::getDocument();

				switch ($extension)
				{
					case 'js':
						$doc->addScript($tplUrl . '/' . $extension . '/' . $asset);
						break;

					case 'css':
						$doc->addStyleSheet($tplUrl . '/' . $extension . '/' . $asset);
						break;

					default:
						// Asset extension not supported
						break;
				}
			}
		}

		return;
	}

	/**
	 * Method to get the field label.
	 *
	 * @return  string  The field label.
	 *
	 * @since   2.0
	 */
	function getLabel()
	{
		return null;
	}
}
