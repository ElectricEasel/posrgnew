<?php defined('_JEXEC') or die;

class PartsModelList extends JModelList
{
	/** @var \JSite  */
	protected $app;

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->context = null;
		$this->app = JFactory::getApplication();
	}
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);

		$keyword = $this->app->input->get('keyword');
		$this->setState('filter.keyword', $keyword);

		$num = $this->app->input->get('part_number');
		$this->setState('filter.num', $num);

		$mfc = $this->app->input->getString('mfc');
		$this->setState('filter.mfc', $mfc);

		$params = $this->app->getParams();
		$this->setState('params', $params);

		$start = $this->app->input->get('start', 0);
		$this->setState('list.start', $start);
		$this->setState('list.limit', 30);
	}

	public function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true)
			->select('*')
			->from('#__parts');

		$mfc = $this->getState('filter.mfc');
		if($mfc)
		{
			$mfc = $db->escape($mfc);
			$query->where("mfc like '%{$mfc}%'");
		}

		$keyword = $this->getState('filter.keyword');
		if($keyword)
		{
			$db->escape($keyword);
			$query->where("(mfc LIKE '%{$keyword}%' OR part_number LIKE '%{$keyword}%' OR des LIKE '%{$keyword}%' )");
		}

		$num = $this->getState('filter.part_number');
		if($num)
		{
			$db->escape($num);
			$query->where("part_number LIKE '%{$num}%'");
		}

		return $query;
	}

	public function getMfcSelectList()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true)
			->select('mfc AS value, mfc AS text')
			->from('#__parts')
			->group('mfc')
			->where('mfc != ""')
			->order('mfc ASC');

		$items = (array) $db->setQuery($query)->loadObjectList();

		$obj = new stdClass;
		$obj->value = '';
		$obj->text = '';
		array_unshift($items, $obj);

		$selected = $this->getState('filter.mfc');
		$attribs = array(
			'class' => 'gm-select',
			'data-placeholder' => 'Select a MFR'
		);

		return JHTML::_('select.genericlist', $items, 'mfc', $attribs, 'value', 'text', $selected);
	}
}
