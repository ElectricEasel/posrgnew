<?php defined('_JEXEC') or die;

class WantedModelManager extends JModelList
{
	protected $app;
	protected $context = 'com_wanted.manager';

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->app = JFactory::getApplication();
	}

	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);

		$search = $this->app->getUserStateFromRequest("com_wanted.search", 'search', '', 'string');
		$search = strtolower($search);
		$this->setState('filter.search', $search);

		$params = $this->app->getParams();
		$this->setState('params', $params);

        $this->setState('list.limit', 0);
	}

	public function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true)
			->select('*')
			->from('#__wanted')
            ->order('ordering ASC');

		$search = $this->getState('filter.search');
		if ($search)
		{
			$search = $db->escape($search);
			$query->where("title LIKE '%{$search}%'");
		}

		return $query;
	}

    /**
     * Saves the manually set order of records.
     *
     * @param   array    $pks    An array of primary key ids.
     * @param   integer  $order  +1 or -1
     *
     * @return  mixed
     *
     * @since   12.2
     */
    public function saveorder($pks = null, $order = null)
    {
        $table = new WantedTableEntry;

        if (empty($pks))
        {
            return JError::raiseWarning(500, JText::_('ERROR_NO_ITEMS_SELECTED'));
        }

        // Update ordering values
        foreach ($pks as $i => $pk)
        {
            $table->load((int) $pk);

            $table->ordering = $order[$i];

            if (!$table->store())
            {
                $this->setError($table->getError());
                return false;
            }
        }

        return true;
    }
}
