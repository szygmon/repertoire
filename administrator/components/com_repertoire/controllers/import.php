<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerImport extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        //$this->view_list = 'repertoire'; // przekierowanie po zapisie/edycji...
    }

    public function import() {
        $result = $this->getModel()->importSongs();

        // przekierowanie z wiadomością
        if ($result) {
            $this->setRedirect('index.php?option=com_repertoire', JText::_('COM_REPERTOIRE_IMPORT_SUCCESS'));
        } else {
            $this->setRedirect('index.php?option=com_repertoire', JText::_('COM_REPERTOIRE_IMPORT_ERROR'));
        }
    }

}
