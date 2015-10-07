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
                ->select('*')
                ->from($db->quoteName('#__repertoire'));
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObjectList();
        
        return array('rows' => $result, 'count' => count($result));
    }

}
