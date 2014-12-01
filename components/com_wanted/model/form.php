<?php defined('_JEXEC') or die;

class WantedModelForm extends JModelItem
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
	protected function populateState()
	{
		parent::populateState();

		$id = $this->app->input->getInt('id');
		$this->setState('item.id', $id);

		$params = $this->app->getParams();
		$this->setState('params', $params);

		$this->setState('list.limit', 20);
	}

	public function getItem()
	{
		if (is_null($this->_item))
		{
			$id = $this->getState('item.id');

			$db = $this->getDbo();
			$query = $db->getQuery(true)
				->select('*')
				->from('#__wanted')
				->where('id = ' . $id);

			$this->_item = $db->setQuery($query)->loadObject();
		}

		return $this->_item;
	}
}
