<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_repertoire
 *
 * @copyright   Copyright (C) 2015 Szymon Michalewicz. All rights reserved.
 */

// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

/**
 * Model for repertoire
 */
class RepertoireModelRepertoire extends JModelList {
    
    /**
     * Metoda zwracająca listę utworów w repertuarze zespołu
     * 
     * @return  array   Tablica obiektów tabeli #__repertoire
     * oraz pole category zawierającę nazwę kategorii utworu
     */
    public function getRepertoire() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
                ->select('#__repertoire.*, #__categories.title as category')
                ->leftJoin('#__categories on catid=#__categories.id')
                ->from($db->quoteName('#__repertoire'));
        
        $db->setQuery($query);
        $result = $db->loadObjectList();

        return $result;
    }
}
