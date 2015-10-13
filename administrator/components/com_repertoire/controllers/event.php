<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerEvent extends JControllerForm {

    // Przekierowanie do widoku do druku
    public function toprint() {
        $id = JRequest::getVar('id');
        $this->setRedirect('index.php?option=com_repertoire&view=events&layout=list&tmpl=component&print=1&id='.$id);
    }

}
