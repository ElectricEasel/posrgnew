<?php defined('_JEXEC') or die;

class PartsViewList extends JView
{
	public function display($tpl = null)
	{
		$this->data = $this->get('Items');
		$this->state = $this->get('State');
		$this->pagination = $this->get('Pagination');
		$this->mfcSelectList = $this->get('MfcSelectList');

		parent::display($tpl);
	}
}
