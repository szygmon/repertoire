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
 * The repertoire controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_repertoire
 */
class RepertoireControllerSong extends JControllerForm {
    
    function __construct($config = array()) {
        parent::__construct($config);
        // Zmiana widoku po zapisie/edycji utworu
        $this->view_list = 'repertoire'; 
    }

    // Obsługa ładowania/usuwania pliku MP3
    public function save($key = null, $urlVar = null) {
        $songid = JRequest::getVar('id');
        $jform = JFactory::getApplication()->input->get('jform', array(), 'array');
        $deletefile = $jform['removemp3'];
        
        // Wywołanie rodzica
        parent::save($key, $urlVar);
        
        $this->getModel()->saveSong($songid, $deletefile);
    }
}
