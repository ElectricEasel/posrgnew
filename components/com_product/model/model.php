<?php defined('_JEXEC') or die;

class ProductModel extends JModel
{
	public $_query 		= array('query' => null, 'join' => null, 'where' =>  null, 'group' => null, 'order' => null);
	public $_col			= array();
	public $_limitstart	= 0;
	public $_limit			= 0;
	public $_table			= "#__users";

	function setOrder($items, $order, $table)
	{
		$total		= count( $items );
		$row		= $this->getTable($table);

		for( $i=0; $i < $total; $i++ ) {
			$row->load( $items[$i] );

			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];

				if (!$row->store()) {
					$this->setError($row->getError());
					return false;
					exit();
				}
			}
		}
		$this->reorder($row);

		return true;
	}

	function reorder($table, $where = '')
	{
		if (! in_array('ordering', array_keys($table->getProperties())))
		{
			$this->setError( get_class( $table ).' does not support ordering');
			return false;
		}

		if($mode > 2) $mode = 0;

		$model = new mcModel();


		$model->reset()->setTable('#__product')
		->select('id, ordering')
		->where('ordering >= 0')

		->order(array('ordering' => 'asc'))
		->order(array('id'       => 'asc'))

		;

		$orders = $model->getListData();


		$i = 0;

		foreach($orders as $item){

				if ($item->ordering != $i+1){
					$item->ordering = $i+1;
					$model->saveData($item, array() , 'product');
				}
			$i++;
		}


		return true;
	}

	function mcModel($config = array())
	{
		parent::__construct($config);
	//	return $this;
	}

	// event for database

	function beforeQuery()
	{
		return $this;
	}

	function afterQuery()
	{
		return $this;
	}

	function beforeSave()
	{
		return $this;
	}

	function afterSave()
	{
		return $this;
	}


	function bug($next = true)
	{
		echo "<pre>"; print_r(implode(" ", $this->_query));
		if($next)
		{
			return $this;
		}
		else
		{
			exit();
		}
	}

	function getError()
	{
		if($this->_db->_errorNum)
		{
			return $this->_db->_errorMsg;
		}

		return false;

	}

	/**
	 * Reset query to default
	 *
	 * @return object model
	 */
	function reset()
	{
		$this->_query 		= array('query' => null, 'join' => null, 'where' =>  null, 'group' => null, 'order' => null);
		$this->_limitstart 	= 0;
		$this->_limit		= 0;
		$this->_table		= '#__users';
		$this->_col			= array();
		return $this;

	}
	/**
	 * Change table default
	 *
	 * @param string $table name of table
	 * @return object model
	 */
	function setTable($table)
	{
		$this->_table = $table;

		return $this;
	}



	function delete($bug=false, $next = false)
	{
		$this->_query['query'] = "DELETE FROM {$this->_table} ";

		$bug	? $this->bug($next) : "";

		// event
		$this->beforeQuery();

		$this->_db->setQuery(implode(" ", $this->_query));


		$this->afterQuery();

		if (!$this->_db->query())
		{
			return $this->_db->getErrorMsg();
		}
	}

	function getListData($bug=false, $next = false)
	{
		$this->_query['query'] = "SELECT ".implode(",\n" , $this->_col)." \nFROM \n\t{$this->_table} ";

		$bug	? $this->bug($next) : "";

		$this->beforeQuery();
		$query 	= implode(" ", $this->_query);
		$this->afterQuery();

		$data =  $this->_getList($query,  $this->_limitstart , $this->_limit);
		return count($data) ? $data : array();

	}

	function getData($bug=false, $next = false)
	{
		$this->_query['query'] = "SELECT ".implode(', ' , $this->_col)." \nFROM \n\t{$this->_table} ";

		$bug	? $this->bug($next) : "";

		$this->beforeQuery();

		$query 	= implode(" ", $this->_query);

		$this->afterQuery();

		//JFactory::bug($query);

		$this->_db->setQuery($query);

		return $this->_db->loadObject();
	}

	function update($data = array(), $bug=false, $next = false)
	{
		$col = array();

		foreach ($data as $k=>$v)
		{
			$col[] = " $k = '$v' ";
		}

		$this->_query['query'] = count($col) ?  "update $this->_table set " . implode(',', $col) : "";

		$bug	? $this->bug($next) : "";

		if($this->_query['query'])
		{

			$this->_db->setQuery( implode(' ', $this->_query));

			$this->_db->query();

			return $this->_db->_errorMsg;
		}
		else
		{
			return "Can't not update to table $this->_table ";
		}


	}

	public function hit($id, $table){
		$table = $this->getTable($table);
		$table->hit($id);
		return $this;
	}

	function saveData($source, $notallow = array(), $table = '', $nameTable = '', $fieldid = '')
	{
		$table = $this->getTable($table);

		if($nameTable){
			$table->_tbl = $nameTable;

		}

		if($fieldid){
			$table->_tbl_key = $fieldid;
		}

		$this->beforeSave();

		if(!$table->bind($source, $notallow))
		{

			return false;
		}

		$this->afterSave();

		$table->store();

		return $table;


	}
	/**
	 * Enter description here...
	 *
	 * @param mixed $col
	 * @return object model
	 */
	function addSelect($arg){
		$this->_col[] = "\t" . $arg;
		return $this;
	}

	function select($col = "*")
	{
		$arr	= array();

		if($this->_col[$this->_table])
		{
			$arr[]	=  $this->_col[$this->_table];
		}

		$col	= is_array($col) ? $col :  explode(',', $col);

		foreach ($col as $item)
		{
			$arr[]	= "$this->_table." . trim($item);
		}



		$this->_col[$this->_table] = "\t" . implode(', ', $arr);


		//$this->_query['query'] = "SELECT {$col} FROM {$this->_table} as main ";

		return $this;
	}

	function join($_table, $condition, $col = null, $join = "INNER JOIN", $as_table = '')
	{


		if($col)
		{
			$arr	= array();

			$col	= is_array($col) ? $col :  explode(',', $col);

			foreach ($col as $item)
			{
				$_tbl 	= $as_table ? $as_table : $_table;
				$arr[]	= "$_tbl." .trim($item);
			}



			$this->_col[$as_table ? $as_table : $_table] = "\t" . implode(', ', $arr);
		}

		$this->_query['join'] .= "\n$join \n\t$_table ON $condition ";

		return $this;
	}

	/**
	 * where
	 *
	 * @param mixed $arg array(k1=>v1, k2=>v2)
	 * @return object model
	 */
	function where($arg)
	{
		$where = array();

		if(is_array($arg))
		{
			foreach ($arg as $k=>$v)
			{
				if(strpos($k, '?'))
				{
					$where[] = str_replace("?", $v, $k);
				}
				else
				{
					$where[] 	.= " $k $v ";
				}

			}
		}
		else if($arg)
		{

			$where[] = $arg;
		}

		if(!count($where))
		{
			return $this;
		}

		$this->_query['where']	.= ($this->_query['where'] == null &&  count($where)) ? "\nWHERE\n\t" : "\n\tAND ";



		$this->_query['where']	.= count($where) ? implode(" AND ", $where) : "";

		return $this;
	}


	/**
	 * Group by
	 *
	 * @param string $arg --- EX:id,name
	 */

	function group($arg = null)
	{
		$this->_query['group']	.= ($this->_query['group'] == null &&  $arg) ? "\nGROUP BY " : ",";

		$this->_query['group'] 	.= $arg ? $arg : "";

		return $this;
	}

	/**
	 * order
	 *
	 * @param array $arg array(k1=>v1, k2=>v2)
	 * @return object model
	 */

	function order($arg = array())
	{

		$order = array();

		foreach ($arg as $k=>$v)
		{
			$order[] 	.= "$k $v";
		}

		if(!count($order))
		{
			return $this;
		}

		$this->_query['order']	.= ($this->_query['order'] == null) ? "\nORDER BY \n\t" : ",";

		$this->_query['order']	.= implode(',', $order);

		return $this;
	}
	/**
	 * limit
	 *
	 * @param int $start
	 * @param int $end
	 * @return object model
	 */
	function limit($start, $end)
	{
		$this->_limitstart 	= $start 	? $start 	: 0;

		$this->_limit		= $end 		? $end 		: 0;

		return $this;
	}

}
