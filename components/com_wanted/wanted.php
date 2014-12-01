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
    ->addScript('http://code.jquery.com/jquery-1.9.1.js"')
    ->addScript('http://code.jquery.com/ui/1.10.4/jquery-ui.js')
	->addStyleSheet('components/com_product/assets/css/template.css');

JLoader::registerPrefix('Wanted', dirname(__FILE__));

$app = JFactory::getApplication();

$controller = new WantedController;
$controller->execute($app->input->get('task'));
$controller->redirect();
