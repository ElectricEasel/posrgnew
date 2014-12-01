<?php defined('_JEXEC') or die;

class WantedModelList extends JModelList
{
	protected $app;

	public function __construct($config = array())
	{
		parent::__construct($config);

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

		$params = $this->app->getParams();

		$this->setState('params', $params);
		$this->setState('list.limit', 0);
	}

	public function getListQuery()
	{
		return $this->getDbo()
			->getQuery(true)
			->select('*')
			->from('#__wanted')
            ->order('title asc');
	}
}
