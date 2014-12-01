<?php defined('_JEXEC') or die;

class WantedViewManager extends JView
{
	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');

		$this->lists = array(
			'order_Dir' => $this->state->get('list.direction'),
			'order'     => $this->state->get('list.ordering'),
			'search'    => $this->state->get('filter.search')
		);

		parent::display($tpl);
	}

	public function order($rows, $image = 'filesave.png', $task = "saveorder")
	{
		$image = '<img src="' . JUri::base() . 'components/com_product/assets/images/' . $image . '" alt="save order" />';
		return '<a href="javascript:saveorder('.(count( $rows )-1).', \''.$task.'\')" title="'.JText::_( 'Save Order' ).'">'.$image.'</a>';
	}
}
