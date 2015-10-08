<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireModelRepertoire extends JModelItem {

    /**
     * Gets the greeting
     * @return string The greeting to be displayed to the user
     */
    function getGreeting() {
        return 'Hello, World!';
    }

    function getRepertoire() {
        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                ->select('#__repertoire.*, #__categories.title as category')
                ->leftJoin('#__categories on catid=#__categories.id')
                ->from($db->quoteName('#__repertoire'));
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObjectList();
        
        return array('rows' => $result, 'count' => count($result));
    }

}
