<?php
/**
* @package   ZOO Component
* @file      itemcategory.php
* @version   2.4.9 May 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

/*
   Class: ElementParentCategory
       The item category element class
*/

class ElementParentCategory extends Element {

	public $parent_cat_id;

	/*
		Function: hasValue
			Checks if the element's value is set.

	   Parameters:
			$params - render parameter

		Returns:
			Boolean - true, on success
	*/
	public function hasValue($params = array()) {
		$categories = $this->_item->getRelatedCategories(true);
		return !empty($categories);
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

		$this->getItemsParentCategoryId($this->_item->id);
		$linked = isset($params['linked']) && $params['linked'];

		$values = array();
		
		if($parent_category = $this->app->table->category->getById($this->parent_cat_id))
		{
			foreach($parent_category as $category)
			{
				$values[] = $linked ? '<a href="'.JRoute::_($this->app->route->category($category)).'">'.$category->name.'</a>' : $category->name;
			}
		}
		
		return $this->app->element->applySeparators($params['separated_by'], $values);

	}

	/*
	   Function: edit
	       Renders the edit form field.

	   Returns:
	       String - html
	*/
	public function edit() {
		return null;
	}

	/*
	   Function: getItemsParentCategory
	       Method to retreive item's parent category link.

	   Returns:
	       String - html
	*/
	public function getItemsParentCategoryId($item_id)
	{
		$categories = $this->app->category->getItemsRelatedCategoryIds($item_id);
		
		return $this->getCatParent($categories[0]);
	}

	/*
		Function: getCatParent
			Method to retrieve item's parent category id.

		Returns:
			Int - category id
	*/
	public function getCatParent($cat_id) 
	{
		//print_r($this->app); die();
		
		$query = 'SELECT parent'
		        .' FROM '.ZOO_TABLE_CATEGORY
			    .' WHERE id='.(int) $cat_id;

		$cat_parent = $this->app->database->queryResult($query);
		if($cat_parent == 0)
		{
			$this->parent_cat_id = (int) $cat_id;
		}
		else
		{
			$this->getCatParent($cat_parent);
		}
	}

}