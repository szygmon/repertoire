<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireModelCategories extends JModelList {

    function getCategories() {
        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__repertoire_categories'));
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObjectList();

        return $result;
    }

}
