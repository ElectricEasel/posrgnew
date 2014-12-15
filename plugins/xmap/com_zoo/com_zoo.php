<?php
/**
 * @version     2.1
 * @package     Joomla
 * @subpackage  Xmap - Zoo Plugin
 * @copyright   (C) 2013 ElectricEasel
 * @license     GNU/GPL
 */
defined('_JEXEC') or die;

class xmap_com_zoo
{
	public static function prepareMenuItem(&$node)
	{
		$link_query = parse_url( $node->link );
		parse_str(html_entity_decode($link_query['query']), $link_vars);
		$component = JArrayHelper::getValue($link_vars, 'option', '');
		$view = JArrayHelper::getValue($link_vars,'view','');

		if ($component == 'com_zoo' && $view == 'frontpage')
		{
			$id = (int) JArrayHelper::getValue($link_vars, 'id', 0);

			if ($id !== 0)
			{
				$node->uid = 'zoo'.$id;
				$node->expandible = false;
			}
		}
	}

	public static function getTree(&$xmap, &$parent, &$params)
	{	
		$link_query = parse_url( $parent->link );
		parse_str( html_entity_decode($link_query['query']), $link_vars);
		$view = JArrayHelper::getValue($link_vars,'view',0);

		$include_categories = JArrayHelper::getValue($params, 'include_categories', 1, '');
		$include_categories = ($include_categories == 1
				  || ( $include_categories == 2 && $xmap->view == 'xml')
				  || ( $include_categories == 3 && $xmap->view == 'html')
				  ||   $xmap->view == 'navigator');
		$params['include_categories'] = $include_categories;
				
		$include_items = JArrayHelper::getValue($params, 'include_items', 1, '');
		$include_items = ($include_items == 1
				  || ($include_items == 2 && $xmap->view == 'xml')
				  || ($include_items == 3 && $xmap->view == 'html')
				  ||   $xmap->view == 'navigator');
		$params['include_items'] = $include_items;

		$priority = JArrayHelper::getValue($params, 'cat_priority', $parent->priority, '');
		$changefreq = JArrayHelper::getValue($params, 'cat_changefreq', $parent->changefreq, '');

		if ($priority  == '-1')
		{
			$priority = $parent->priority;
		}
		if ($changefreq  == '-1')
		{
			$changefreq = $parent->changefreq;
		}

		$params['cat_priority'] = $priority;
		$params['cat_changefreq'] = $changefreq;

		$priority = JArrayHelper::getValue($params, 'item_priority', $parent->priority, '');
		$changefreq = JArrayHelper::getValue($params, 'item_changefreq', $parent->changefreq, '');

		if ($priority  == '-1')
		{
			$priority = $parent->priority;
		}

		if ($changefreq  == '-1')
		{
			$changefreq = $parent->changefreq;
		}

		$params['item_priority'] = $priority;
		$params['item_changefreq'] = $changefreq;

		self::getCategoryTree($xmap, $parent, $params);
	}

	protected static function getCategoryTree(&$xmap, &$parent, &$params)
	{
		$app   = JFactory::getApplication();
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$appid = (int) $app->getMenu()->getParams($parent->id)->get('application', 0);
		
		// Include categories if selected.
		if ($params['include_categories'])
		{
			$query
				->select('c.id, c.name')
				->from('#__zoo_category AS c')
				->where('c.application_id = ' . $appid)
				->where('c.published = 1')
				->order('c.ordering ASC');

			$cats = $db->setQuery($query)->loadObjectList();
			
			// now we print categories
			$xmap->changeLevel(1);

			foreach($cats as $cat)
			{
				$node = new stdclass;
				$node->id   = $parent->id;
				$node->uid  = $parent->uid .'c'.$cat->id;
				$node->name = $cat->name;
				$node->link = self::buildLink('category', $cat->id);
				$node->priority   = $params['cat_priority'];
				$node->changefreq = $params['cat_changefreq'];
				$node->expandible = true;
				$node->modified = time();

				$xmap->printNode($node);
			}

			$xmap->changeLevel(-1);
		}

		// Include items if selected.
		if ($params['include_items'])
		{
			$query
				->clear()
				->select('i.id, i.name, i.publish_up, i.application_id')
				->from('#__zoo_item AS i')
				->where('i.application_id = ' . $appid)
				->where('DATEDIFF(i.publish_up, NOW()) <= 0')
				->where('IF(i.publish_down > 0, DATEDIFF(i.publish_down, NOW()) > 0, true)')
				->order('i.publish_up ASC');

			$items = $db->setQuery($query)->loadObjectList();
						
			// now we print items
			$xmap->changeLevel(1);

			foreach($items as $item)
			{
				// if we are making news map, we should ignore items older then 3 days
				if ($xmap->isNews && strtotime($item->publish_up) < ($xmap->now - (3 * 86400)))
				{
                    continue;
                }

				$node = new stdclass;
				$node->id   = $parent->id;
				$node->uid  = $parent->uid .'i'.$item->id;
				$node->name = $item->name;
				$node->link = self::buildLink('item', $item->id);
				$node->priority   = $params['item_priority'];
				$node->changefreq = $params['item_changefreq'];
				$node->expandible = true;
				$node->modified = strtotime($item->publish_up);
				$node->newsItem = 1; // if we are making news map and it get this far, it's news

				$xmap->printNode($node);
			}

			$xmap->changeLevel(-1);
		}
	}
	
	protected static function buildLink($type, $id)
	{
		require_once JPATH_ADMINISTRATOR . '/components/com_zoo/config.php';
		
		$zoo = App::getInstance('zoo');
		$item = $zoo->table->{$type}->get($id);

		return $zoo->route->{$type}($item, false);
	}
}
