<?php
defined('_JEXEC') or die;

include_once 'helper/helper.php';

/**
 * @param	array	A named array
 * @return	array
 */
function PartsBuildRoute(&$query)
{
	$segments = array();

	if (isset($query['view']))
	{
		$Itemid = JRequest::getVar('parts.' . $query['view'] . '.itemid');

		if (empty($Itemid))
		{
			$db = JFactory::getDbo();
			$q = $db->getQuery(true)
				->select('id')
				->from('#__menu')
				->where('link LIKE ' . $db->quote('%option=com_parts%'))
				->where('link LIKE ' . $db->quote('%view=' . $db->escape($query['view']) . '%'));

			$Itemid = $db->setQuery($q)->loadResult();

			if ($Itemid)
			{
				JRequest::setVar('parts.' . $query['view'] . '.itemid', $Itemid);
			}
		}

		$query['Itemid'] = $Itemid;
	}

	// If present, use the declared mfc.
	if (isset($query['mfc']))
	{
		$segments[] = $query['mfc'];
		unset($query['mfc']);
	}
	else // try to guess it from the product id.
	{
		if (isset($query['id']))
		{
			$segments[] = PartsHelper::getMfcFromId($query['id']);
			unset($query['mfc']);
		}
	}

	if (isset($query['id']))
	{
		$segments[] = PartsHelper::getPartNumberFromId($query['id']);
		unset($query['id']);
	}

	// remove the view from the URL
	unset($query['view']);

	return $segments;
}

/**
 * Parse the given segments into input vars.
 *
 * @param   array  $segments  The URL segments
 *
 * @return  array
 */
function PartsParseRoute($segments)
{
	$args = array();
	$count = count($segments);

	if ($count === 1)
	{
		$idFromPN = PartsHelper::getIdFromPartNumber($segments[0]);

		if ($idFromPN)
		{
			$args['id'] = $idFromPN;
			$args['view'] = 'form';
		}
		else
		{
			$args['mfc'] = $segments[0];
			$args['view'] = 'list';
		}
	}
	elseif ($count === 2)
	{
		$args['mfc'] = $segments[0];
		$args['id'] = PartsHelper::getIdFromPartNumber($segments[1]);
		$args['view'] = 'form';
	}

	return $args;
}