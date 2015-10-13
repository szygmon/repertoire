<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerImport extends JControllerForm {
    // Import z Excela
    public function import() {
        $result = $this->getModel()->importSongs();

        // Przekierowanie z odpowiednią wiadomością
        if ($result) {
            $this->setRedirect('index.php?option=com_repertoire', JText::_('COM_REPERTOIRE_IMPORT_SUCCESS'));
        } else {
            $this->setRedirect('index.php?option=com_repertoire', JText::_('COM_REPERTOIRE_IMPORT_ERROR'));
        }
    }

}
