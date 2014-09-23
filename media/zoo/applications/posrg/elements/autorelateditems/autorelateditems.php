<?php
/**
* @package   ZOO Component
* @file      autorelateditems.php
* @version   2.4.9 May 2011
* @author    Don Gilbert - Electric Easel, Inc. http://www.electriceasel.com
* @copyright Copyright (C) 2011 Electric Easel, Inc.
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

/*
	Class: ElementAutoRelatedItems
		The related items element class
*/
class ElementAutoRelatedItems extends Element {

	protected $_related_items;

	/*
		Function: hasValue
			Checks if the element's value is set.

	   Parameters:
			$params - render parameter

		Returns:
			Boolean - true, on success
	*/		
	public function hasValue($params = array()) {
		$items = $this->_getRelatedItems($params['limit']);
		return !empty($items);
	}		
	
	/*
		Function: render
			Renders the element.

	   Parameters:
            $params - render parameter

		Returns:
			String - html
	*/
	public function render($params = array()) {
		
		// init vars
		$params   = $this->app->data->create($params);
		$items    = array();
		$output   = array();
		$renderer = $this->app->renderer->create('item')->addPath(array($this->app->path->path('component.site:'), $this->_item->getApplication()->getTemplate()->getPath()));
		$layout   = $params->get('layout');

		$items = $this->_getRelatedItems($params->limit);

		// sort items
		$order = $params->get('order');
		if (in_array($order, array('alpha', 'ralpha'))) {
			usort($items, create_function('$a,$b', 'return strcmp($a->name, $b->name);'));
		} elseif (in_array($order, array('date', 'rdate'))) {
			usort($items, create_function('$a,$b', 'return (strtotime($a->created) == strtotime($b->created)) ? 0 : (strtotime($a->created) < strtotime($b->created)) ? -1 : 1;'));
		} elseif (in_array($order, array('hits', 'rhits'))) {
			usort($items, create_function('$a,$b', 'return ($a->hits == $b->hits) ? 0 : ($a->hits < $b->hits) ? -1 : 1;'));
		} elseif ($order == 'random') {
			shuffle($items);
		} else {
			
		}
		
		if (in_array($order, array('ralpha', 'rdate', 'rhits'))) {
			$items = array_reverse($items);
		}

		// create output
		foreach($items as $item) {
			$path   = 'item';
			$prefix = 'item.';
			$type   = $item->getType()->id;
			if ($renderer->pathExists($path.DIRECTORY_SEPARATOR.$type)) {
				$path   .= DIRECTORY_SEPARATOR.$type;
				$prefix .= $type.'.';
			}

			if (in_array($layout, $renderer->getLayouts($path))) {
				$output[] = $renderer->render($prefix.$layout, array('item' => $item));
			} elseif ($params->get('link_to_item', false) && $item->getState()) {
				$url	  = $this->app->route->item($item);
				$output[] = '<a href="'.JRoute::_($url).'" title="'.$item->name.'">'.$item->name.'</a>';
			} else {
				$output[] = $item->name;
			}
		}
		
		return '<div class="gray_box">' . $this->app->element->applySeparators($params->get('separated_by'), $output) . "</div>";
	}
	
	protected function _getRelatedItems($limit = 5, $published = true) {

		if ($this->_related_items == null) {

			// init vars
			$table = $this->app->table->item;
			$this->_related_items = array();

			// get items
			$items = $this->findRelatedItems($limit); //_data->get('item', array());
			// check if items have already been retrieved
			if($items)
			foreach ($items as $key => $id) {
				if ($table->isInitialized($id)) {
					$this->_related_items[$id] = $table->get($id);
					unset($items[$key]);
				}
			}

			if (!empty($items)) {
				// get dates
				$db   = $this->app->database;
				$date = $this->app->date->create();
				$now  = $db->Quote($date->toMySQL());
				$null = $db->Quote($db->getNullDate());
				$items_string = implode(', ', $items);
				$conditions = $table->key.' IN ('.$items_string.')'
							. ($published ? ' AND state = 1'
							.' AND '.$this->app->user->getDBAccessString()
							.' AND (publish_up = '.$null.' OR publish_up <= '.$now.')'
							.' AND (publish_down = '.$null.' OR publish_down >= '.$now.')' : '');
				$order = 'FIELD('.$table->key.','.$items_string.')';
				$this->_related_items += $table->all(compact('conditions', 'order'));
			}

		}

		return $this->_related_items;
	}
	
	public function findRelatedItems($limit)
	{
		$item_id = $this->app->request->getInt('item_id', 0);
		
		$query = "SELECT b.item_id"
			.' FROM '.ZOO_TABLE_CATEGORY_ITEM.' AS a'
			.' JOIN '.ZOO_TABLE_CATEGORY_ITEM.' AS b ON a.item_id = '. (int) $item_id
			.' WHERE a.category_id = b.category_id ORDER BY RAND()'
			.' LIMIT '. (int) $limit;
		$items = $this->app->database->queryResultArray($query);
		foreach($items as $key => $value)
		{
			if($value == $item_id)
			{
				unset($items[$key]);
			}
		}
		
		return $items;
	}
	
	/*
	   Function: edit
	       Placeholder function

	   Returns:
	       True
	*/
	public function edit() {
		return true;
	}
	
}