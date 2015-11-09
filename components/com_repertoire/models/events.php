<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_repertoire
 *
 * @copyright   Copyright (C) 2015 Szymon Michalewicz. All rights reserved.
 */

// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

/**
 * Model dla ustalania repertuaru dla wydarzeń przez gości
 */
class RepertoireModelEvents extends JModelItem {

    /**
     * Metoda pobiera repertuar muzyczny zespołu
     * 
     * @return  array   Lista obiektów tabeli #__repertoire
     * oraz pole category zaiwrające nazwę kategorii utworu
     */
    function getRepertoire() {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true)
                ->select('#__repertoire.*, #__categories.title as category')
                ->leftJoin('#__categories on catid=#__categories.id')
                ->from($db->quoteName('#__repertoire'));

        $db->setQuery($query);
        $result = $db->loadObjectList();

        return $result;
    }

    /**
     * Metoda sprawdzająca poprawność formularza dla wyboru wydarzenia przez klienta
     * 
     * @param   date    $date   Data wydarzenia w formacie Y-m-d
     * @param   text    $pass   Hasło dla wydarzenia - opcjonalnie
     * 
     * @return  int     ID wydarzenia
     */
    function check($date, $pass = '') {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true)
                ->select('id')
                ->from($db->quoteName('#__repertoire_events'))
                ->where('date = "' . $date . '" AND (pass = "' . $pass . '" OR pass = "NULL")');

        $db->setQuery($query);
        $result = $db->loadObject();

        return $result->id;
    }

    /**
     * Metoda pobierająca dane na temat wydarzenia
     * 
     * @return  Object  Obiekt zawierający pola tabeli #__repertoire_events dla wybranego wydarzenia
     */
    function getEvent() {
        $id = JRequest::getVar('id', 0, '', 'INT');
        
        if ($id) {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true)
                    ->select('*')
                    ->from($db->quoteName('#__repertoire_events'))
                    ->where('id = ' . $id);

            $db->setQuery($query);
            $result = $db->loadObject();

            return $result;
        }
        return NULL;
    }

    /**
     * Metoda dodająca utwór do tabeli #__repertoire_songs_events w BD
     * 
     * @param   int     $songid     ID utworu
     * @param   int     $eventid    ID wydarzenia
     */
    function addSong($songid, $eventid) {
        $row = new stdClass();
        $row->songid = $songid;
        $row->eventid = $eventid;

        JFactory::getDbo()->insertObject('#__repertoire_songs_events', $row);
    }

    /**
     * Metoda dodająca informacje/dedykazje/życzenia do tabeli #__repertoire_info w BD
     * 
     * @param   int     $eventid    ID wydarzenia
     * @param   int     $info       Treść życzenia, dedykacji
     */
    function addInfo($eventid, $info) {
        $row = new stdClass();
        $row->eventid = $eventid;
        $row->info = $info;

        JFactory::getDbo()->insertObject('#__repertoire_info', $row);
    }
}
