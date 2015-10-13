<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerEvent extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->view_list = 'events'; // przekierowanie po zapisie/edycji...
    }

    // Przekierowanie do widoku do druku
    public function toprint() {
        $id = JRequest::getVar('id');
        $this->setRedirect('index.php?option=com_repertoire&view=events&layout=list&tmpl=component&print=1&id='.$id);
    }

}
