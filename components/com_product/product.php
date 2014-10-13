<?php defined('_JEXEC') or die;

jimport('joomla.application.component.helper');
jimport('joomla.application.component.controller');
jimport('joomla.application.component.modelitem');
jimport('joomla.application.component.modellist');
jimport('joomla.application.component.view');
jimport('joomla.filesystem.file');
jimport('joomla.html.pagination');

JHtml::script('mootools.js');
JFactory::getDocument()
	->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js')
	->addStyleSheet('components/com_product/assets/css/template.css');

require_once 'lib/Gd2.php';

JLoader::registerPrefix('Product', dirname(__FILE__));

$app = JFactory::getApplication();

$controller = new ProductController;
$controller->execute($app->input->get('task'));
$controller->redirect();
