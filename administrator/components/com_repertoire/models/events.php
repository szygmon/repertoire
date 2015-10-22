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
                ->select('#__repertoire_events.*, COUNT(#__repertoire_songs_events.songid) as songs, COUNT(#__repertoire_info.eventid) as info')
                ->leftJoin('#__repertoire_songs_events on id=#__repertoire_songs_events.eventid')
                ->leftJoin('#__repertoire_info on id=#__repertoire_info.eventid')
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
                ->select('#__repertoire.*, COUNT(#__repertoire_songs_events.songid) as count, #__categories.title as category')
                ->leftJoin('#__repertoire_songs_events on id=#__repertoire_songs_events.songid')
                //->leftJoin('#__repertoire_events on #__repertoire_songs_events.eventid=#__repertoire_events.id')
                ->leftJoin('#__categories on catid=#__categories.id')
                ->from($db->quoteName('#__repertoire'))
                ->where('#__repertoire_songs_events.eventid=' . $event)
                ->group('id')
                ->order('count DESC');

        $db->setQuery($query);
        $result = $db->loadObjectList();

        return $result;
    }

    /*
     * Metoda zwracająca informacje: datę i nazwę wydarzenia
     * 
     * @param   int     $id     ID wydarzenia
     * 
     * @return  object  Obekt tabeli #__repertoire_events
     */
    function getEventInfo($id) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->select('name, date')
                ->from($db->quoteName('#__repertoire_events'))
                ->where('id=' . $id);

        $db->setQuery($query);
        $result = $db->loadObject();

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

    /*
     * Metoda usuwająca z BD wydarzenia które już minęły i wszystkie powiązane wpisy
     */
    public function deleteOldEvents() {
        $db = JFactory::getDBO();

        // Wyszukiwanie starych wydarzeń
        $query = $db->getQuery(true)
                ->select('id')
                ->from($db->quoteName('#__repertoire_events'))
                ->where('date < "' . date('Y-m-d') . '"');
        $db->setQuery($query);
        $result = $db->loadObjectList();

        $array = array();
        foreach ($result as $event) {
            $array[] = $event->id;
        }

        if ($array[0]) {
            $idq = implode($array, ',');

            // Usuwanie piosenek dla starych wydarzen
            $query = $db->getQuery(true)
                    ->delete($db->quoteName('#__repertoire_songs_events'))
                    ->where('eventid IN (' . $idq . ')');

            $db->setQuery($query);
            $db->execute();
        }
        
        // Usuwanie wydarzeń
        $query = $db->getQuery(true)
                ->delete($db->quoteName('#__repertoire_events'))
                ->where('date < "' . date('Y-m-d') . '"');

        $db->setQuery($query);
        $db->execute();
    }
    
    /*
     * Metoda pobierająca informacje przesłane przez klientów dla wydarzenia
     * 
     * @param   int     $id     ID wydarzenia
     * 
     * @return  array   Tablica z informacjami od klientów
     */
    function getInfo($id) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->select('info')
                ->from($db->quoteName('#__repertoire_info'))
                ->where('eventid='.$id);
        
        $db->setQuery($query);
        $result = $db->loadRowList();
        
        return $result;
    }
}
