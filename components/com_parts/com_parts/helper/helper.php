<?php defined('_JEXEC') or die;

abstract class PartsHelper
{
	protected static $cache = array();

	/**
	 * Fetch a table row id associated with the given part number.
	 *
	 * @param   string  $partNumber  The part number for which to fetch the row id
	 *
	 * @return  integer
	 */
	public static function getIdFromPartNumber($partNumber)
	{
		$row = self::getRow((string)$partNumber);

		if (is_null($row))
		{
			return false;
		}

		return (int) $row->id;
	}

	/**
	 * Fetch a part number associated with the given id.
	 *
	 * @param   integer  $id  The id for which to fetch the part number
	 *
	 * @return  mixed
	 */
	public static function getPartNumberFromId($id)
	{
		$row = self::getRow((int) $id);

		if (is_null($row))
		{
			return false;
		}

		return str_replace(' ', '-', $row->part_number);
	}

	/**
	 * Fetch a manufacturer associated with the given id.
	 *
	 * @param   integer  $id  The id for which to fetch the manufacturer
	 *
	 * @return  mixed
	 */
	public static function getMfcFromId($id)
	{
		$row = self::getRow((int) $id);

		if (is_null($row))
		{
			return false;
		}

		return $row->mfc;
	}

	/**
	 *
	 *
	 * @param   mixed  $id  String or Integer identifier for the row.
	 *
	 * @return  mixed
	 */
	protected static function getRow($id)
	{
		$cacheId = self::getCacheId($id);

		if (!isset(self::$cache[$cacheId]))
		{
			if (is_int($id))
			{
				$where = 'id = %s';
			}
			else
			{
				// For some reason Joomla replaces the first `-` with a `:`
				$id = preg_replace('/:/', '-', $id, 1);
				$id = str_replace(' ', '-', $id);
				$where = 'REPLACE(part_number, " ", "-") = %s';
			}

			$db = JFactory::getDbo();
			$query = $db->getQuery(true)
			         ->select('id, mfc, part_number')
			         ->from('#__parts')
			         ->where(sprintf($where, $db->quote($db->escape($id))))
			         ->order('CASE WHEN inventory_type = "regular" THEN 1 ELSE 2 END, inventory_type');

			self::$cache[$cacheId] = $db->setQuery($query)->loadObject();
		}

		return self::$cache[$cacheId];
	}

	/**
	 * Create an md5 cache storage ID based on the type and value of $id.
	 *
	 * @param   mixed  $id  string or Integer identifier.
	 *
	 * @return  string
	 */
	protected static function getCacheId($id)
	{
		$type = gettype($id);

		return md5($type . $id);
	}
}
