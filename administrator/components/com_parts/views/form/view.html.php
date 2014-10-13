<?php defined('_JEXEC') or die;

class PartsViewForm extends JView
{
	protected $item;

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->document = JFactory::getDocument();
	}

	public function display($tpl = null)
	{
		$this->item = $this->get('Item');

		$this->prepareDocument();

		parent::display($tpl);
	}

	protected function prepareDocument()
	{
		$title = sprintf(
			'%s %s currently in stock. Shop new, used and refurbished POS equipment - POSRG.com',
			$this->item->mfc,
			$this->item->part_number
		);
		$description = sprintf(
			'%s %s %s is available at POSRG.com. We carry full lines of new, used and refurbished point of sale equipment at competitive prices.',
			$this->item->mfc,
			$this->item->part_number,
			$this->item->des
		);
		$this->document
			->setTitle($title)
			->setDescription(htmlspecialchars($description));
	}
}
