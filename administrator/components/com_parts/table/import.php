<?php defined('_JEXEC') or die;

class PartsTableImport extends JTable
{
	public function __construct()
	{
		$db = JFactory::getDbo();

		parent::__construct( '#__parts', 'id', $db );
	}

	public function truncate($type)
	{
        // Only truncate if we're passing a known type.
        if (in_array($type, array('regular', 'brokerbin', 'other')))
        {
            $db = $this->getDbo();
            $query = $db->getQuery(true)
                ->delete($this->getTableName())
                ->where('inventory_type = ' . $db->quote($type));

            $db->setQuery($query)->execute();
        }
    }
}
