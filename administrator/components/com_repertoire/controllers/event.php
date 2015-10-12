<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerEvent extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->view_list = 'events'; // przekierowanie po zapisie/edycji...
    }

    public function save($key = null, $urlVar = null) {
        // wywołanie rodzica
        parent::save($key, $urlVar);

    }
    
    public function toprint() {
        $id = JRequest::getVar('id');
        $this->setRedirect('index.php?option=com_repertoire&view=events&layout=list&tmpl=component&print=1&id='.$id);
    }

}
