<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireModelEvents extends JModelList {

    function getEvents() {
        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__repertoire_events'));
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObjectList();

        return $result;
    }
}
