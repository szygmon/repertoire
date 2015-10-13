<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access'); 

JLoader::register('RepertoireHelper', JPATH_COMPONENT . '/helpers/repertoire.php');

// Get an instance of the controller prefixed by Repertoire
$controller = JControllerLegacy::getInstance('Repertoire');

// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();



 
 

 
