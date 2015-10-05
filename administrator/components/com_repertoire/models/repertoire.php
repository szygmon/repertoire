<?php
defined('_JEXEC') or die();
jimport('joomla.application.component.model');
class RepertoireModelRepertoire extends JModelLegacy
{
	function getRepertoire() {
        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__repertoire'));
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObjectList();
        
        return array('rows' => $result, 'count' => count($result));
    }
}
?>