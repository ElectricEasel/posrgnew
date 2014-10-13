<?php defined('_JEXEC') or die;

class ProductTableProduct extends JTable
{
	public function __construct()
	{
		$db = JFactory::getDbo();

		parent::__construct('#__product', 'id', $db);
	}

	public function toggleState($pk)
	{
		$this->load($pk);

		$state = $this->published ? 0 : 1;

		return $this->publish($this->id, $state);
	}

	/**
	 * Saves the manually set order of records.
	 *
	 * @param   array    $pks    An array of primary key ids.
	 * @param   integer  $order  +1 or -1
	 *
	 * @return  mixed
	 *
	 * @since   11.1
	 */
	public function saveorder($pks = null, $order = null)
	{
		// Update ordering values
		foreach ($pks as $i => $pk)
		{
			$this->load((int) $pk);
			$this->ordering = $order[$i];
			$this->store();
		}

		return true;
	}
}