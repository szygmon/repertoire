<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access'); 

JLoader::register('RepertoireHelper', __DIR__ . '/helpers/repertoire.php');

// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('Repertoire');

// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();



 
 

 
