<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerSong extends JControllerForm {
    public function __construct($config = array()) {
        parent::__construct($config);
        // Zmiana widoku po zapisie/edycji utworu
        $this->view_list = 'repertoire'; 

    }

    // Obsługa ładowania/usuwania pliku MP3
    public function save($key = null, $urlVar = null) {
        $songid = JRequest::getVar('id');
        $deletefile = JFactory::getApplication()->input->get('jform', array(), 'array')['removemp3'];
        
        // Wywołanie rodzica
        parent::save($key, $urlVar);
        
        $this->getModel()->saveSong($songid, $deletefile);
    }
}
