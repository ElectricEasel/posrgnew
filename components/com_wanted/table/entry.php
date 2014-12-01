<?php defined('_JEXEC') or die;

class WantedTableEntry extends JTable
{
    public $id;
    public $title;
    public $ordering;

	public function __construct()
	{
		$db = JFactory::getDbo();

		parent::__construct('#__wanted', 'id', $db);
	}
}