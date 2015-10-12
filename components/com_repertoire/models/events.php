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
                ->where('date = "' . $date . '" AND (pass = "' . $pass . '" OR pass = "NULL")');
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObject();

        return $result->id;
    }

    function getEvent($id) {
        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                ->select('*')
                ->from($db->quoteName('#__repertoire_events'))
                ->where('id = ' . $id);
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObject();

        return $result;
    }

    function addSong($songid, $eventid) {
        $row = new stdClass();
        $row->songid = $songid;
        $row->eventid = $eventid;

        // Insert the object into the user profile table.
        $result = JFactory::getDbo()->insertObject('#__repertoire_songs_events', $row);
    }

}
