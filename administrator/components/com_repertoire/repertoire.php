<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_repertoire
 *
 * @copyright   Copyright (C) 2015 Szymon Michalewicz. All rights reserved.
 */

// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

// Sprawdzanie dostępu
if (!JFactory::getUser()->authorise('core.manage', 'com_repertoire')) {
    throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('RepertoireHelper', JPATH_COMPONENT . '/helpers/repertoire.php');

// Get an instance of the controller prefixed by Repertoire
$controller = JControllerLegacy::getInstance('Repertoire');

// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();







