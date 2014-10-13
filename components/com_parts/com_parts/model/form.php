<?php defined('_JEXEC') or die;

class PartsModelForm extends JModelItem
{
	protected $app;

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->app = JFactory::getApplication();
	}

	protected function populateState()
	{
		$id = $this->app->input->getInt('id');
		$this->setState('item.id', $id);
	}

	public function getItem()
	{
		if (is_null($this->_item))
		{
			$id = $this->getState('item.id');

			$db = $this->getDbo();
			$query = $db->getQuery(true)
				->select('*')
				->from('#__parts')
				->where('id = ' . $id);

			$this->_item = $db->setQuery($query)->loadObject();

            $imagePathString = '/images/stories/brands/%s_search.png';

            $possiblePath = sprintf($imagePathString, strtolower(str_replace(' ', '_', $this->_item->mfc)));

            if (isset($this->_item->mfc) && file_exists(JPATH_ROOT . $possiblePath))
            {
                $this->_item->image = $possiblePath;
            }
            else
            {
                $this->_item->image = sprintf($imagePathString, 'posrg');
            }
		}

		return $this->_item;
	}
}
