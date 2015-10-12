<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireModelEvents extends JModelItem {
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
        
        return $result;
    }
    
    function check($date, $pass) {
        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                ->select('id')
                ->from($db->quoteName('#__repertoire_events'))
                ->where('date = "'.$date.'" AND (pass = "'.$pass.'" OR pass = "NULL")');
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObject();
        
        return $result->id;
    }
    
    function getEvent($date, $pass) {
        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                ->select('id')
                ->from($db->quoteName('#__repertoire_events'))
                ->where('date = "'.$date.'" AND (pass = "'.$pass.'" OR pass = "NULL")');
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObject();
        
        return $result;
    }
}