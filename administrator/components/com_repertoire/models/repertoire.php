<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireModelRepertoire extends JModelList {
    /*
     * Metoda zwracająca listę utworów w repertuarze zespołu
     * 
     * @return  array   Tablica obiektów tabeli #__repertoire
     * oraz pole category zawierającę nazwę kategorii utworu
     */
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
}
