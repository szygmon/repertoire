<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerSong extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->view_list = 'repertoire'; // przekierowanie po zapisie/edycji...
    }

    public function save($key = null, $urlVar = null) {
        $input = JFactory::getApplication()->input;
        $file = $input->files->get('jform');
        $songid = JRequest::getVar('id');
        
        $deletefile = JFactory::getApplication()->input->get('jform', array(), 'array')['removemp3'];
        
        // wywołanie rodzica
        parent::save($key, $urlVar);
        
        $this->getModel()->saveSong($songid, $file, $deletefile);
    }
}
