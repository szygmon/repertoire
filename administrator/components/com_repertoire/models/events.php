<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireModelEvents extends JModelLegacy {
    /*
     * Metoda pobierająca imprezy z BD
     * 
     * @return  array   tablica obiektów tabeli #__repertoire 
     * i pole songs zawierające ilość utworów dla wydarzenia
     * z tabeli #__repertoire_songs_events
     */
    function getEvents() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->select('#__repertoire_events.*, COUNT(#__repertoire_songs_events.songid) as songs')
                ->leftJoin('#__repertoire_songs_events on id=#__repertoire_songs_events.eventid')
                ->from($db->quoteName('#__repertoire_events'))
                ->group('id');
        
        $db->setQuery($query);
        $result = $db->loadObjectList();

        return $result;
    }

    /*
     * Metoda pobierająca utwory dla danej imprezy
     * 
     * @param   int     $event      ID wydarzenia
     * 
     * @return  array   tablica obiektów tabeli #__repertoire
     * oraz pole count, zawierające ilość wystąpienia danego utworu - popularność,
     * name - nazwę wydarzenia i date - datę wydarzenia
     */
    function getSongs($event) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->select('#__repertoire.*, COUNT(#__repertoire_songs_events.songid) as count, #__repertoire_events.name, #__repertoire_events.date')
                ->leftJoin('#__repertoire_songs_events on id=#__repertoire_songs_events.songid')
                ->leftJoin('#__repertoire_events on #__repertoire_songs_events.eventid=#__repertoire_events.id')
                ->from($db->quoteName('#__repertoire'))
                ->where('#__repertoire_songs_events.eventid=' . $event)
                ->group('id')
                ->order('count DESC');
        
        $db->setQuery($query);
        $result = $db->loadObjectList();

        return $result;
    }

    /*
     * Metoda usuwająca utwory, wybrane przez klientów dla usuwanego wydarzenia
     * 
     * @param   array   $id     Tablica ID usuwanych imprez
     */
    public function deleteEvents($id) {
        $idq = implode($id, ',');
        $db = JFactory::getDBO();

        $query = $db->getQuery(true)
                ->delete($db->quoteName('#__repertoire_songs_events'))
                ->where('eventid IN (' . $idq . ')');
        
        $db->setQuery($query);
        $db->execute();
    }
}
