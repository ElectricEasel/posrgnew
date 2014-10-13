<?php
defined('_JEXEC') or die;

/**
 * @param	array	A named array
 * @return	array
 */
function ProductBuildRoute(&$query)
{
	$segments = array();

	if (isset($query['view']))
	{
		$Itemid = JRequest::getVar('product.' . $query['view'] . '.itemid');

		if (empty($Itemid))
		{
			$db = JFactory::getDbo();
			$q = $db->getQuery(true)
				->select('id')
				->from('#__menu')
				->where('link LIKE ' . $db->quote('%option=com_product%'))
				->where('link LIKE ' . $db->quote('%view=' . $db->escape($query['view']) . '%'));

			$Itemid = $db->setQuery($q)->loadResult();

			if ($Itemid)
			{
				JRequest::setVar('product.' . $query['view'] . '.itemid', $Itemid);
			}
		}

		$query['Itemid'] = $Itemid;
	}

	// remove the view from the URL
	unset($query['view']);

	return $segments;
}

/**
 * @param	array	A named array
 * @param	array
 *
 */
function ProductParseRoute($segments)
{
	$vars = array();

	return $vars;
}