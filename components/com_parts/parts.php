<?php defined('_JEXEC') or die;

jimport('joomla.application.component.helper');
jimport('joomla.application.component.controller');
jimport('joomla.application.component.modelitem');
jimport('joomla.application.component.modellist');
jimport('joomla.application.component.view');
jimport('joomla.database.table');
jimport('joomla.filter.output');
jimport('joomla.html.pagination');
jimport('joomla.utilities.date');
jimport('joomla.filesystem.file');

JFactory::getDocument()
	->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js')
	->addStyleSheet('/components/com_parts/assets/css/style.css');

JLoader::registerPrefix('Parts', dirname(__FILE__));
JLoader::register('Quick_CSV_Import', dirname(__FILE__) . '/lib/Quick_CSV_Import.php');

$app = JFactory::getApplication();

$controller = new PartsController;
$controller->execute($app->input->get('task'));
$controller->redirect();
