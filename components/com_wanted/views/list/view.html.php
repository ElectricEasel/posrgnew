<?php defined('_JEXEC') or die;

class WantedViewList extends JViewLegacy
{
	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
        JArrayHelper::sortObjects($this->items,'ordering');
        $this->pagination = $this->get('Pagination');

		$this->prepareDocument();

		parent::display($tpl);
	}

	protected function prepareDocument()
	{
		JFactory::getDocument()
			->addScript('components/com_product/assets/js/jquery.lightbox.js')
			->addStyleSheet('components/com_product/assets/css/jquery.lightbox.css');
	}
}
