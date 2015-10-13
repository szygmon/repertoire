<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireModelEvents extends JModelLegacy {
    function getEvents() {
        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                ->select('#__repertoire_events.*, COUNT(#__repertoire_songs_events.songid) as songs')
                ->leftJoin('#__repertoire_songs_events on id=#__repertoire_songs_events.eventid')
                ->from($db->quoteName('#__repertoire_events'))
                ->group('id');
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObjectList();

        return $result;
    }

    function getSongs($event) {
        // Obtain a database connection
        $db = JFactory::getDbo();
        // Retrieve the shout
        $query = $db->getQuery(true)
                ->select('#__repertoire.*, COUNT(#__repertoire_songs_events.songid) as count, #__repertoire_events.name, #__repertoire_events.date')
                ->leftJoin('#__repertoire_songs_events on id=#__repertoire_songs_events.songid')
                ->leftJoin('#__repertoire_events on #__repertoire_songs_events.eventid=#__repertoire_events.id')
                ->from($db->quoteName('#__repertoire'))
                ->where('#__repertoire_songs_events.eventid=' . $event)
                ->group('id')
                ->order('count DESC');
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadObjectList();

        return $result;
    }

    public function deleteEvents($id) {
        $idq = implode($id, ',');
        $db = JFactory::getDBO();

        // tabela repertoire_songs_events
        $query = $db->getQuery(true)
                ->delete($db->quoteName('#__repertoire_songs_events'))
                ->where('eventid IN (' . $idq . ')');
        
        $db->setQuery($query);
        $db->execute();
    }

}
