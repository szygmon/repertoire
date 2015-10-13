<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireViewRepertoire extends JViewLegacy {

    function display($tpl = null) {
        $this->rows = $this->get('Repertoire');
$this->item  = $this->get('Item');
        $app = JFactory::getApplication();
        $this->params = $app->getParams();

        parent::display($tpl);
    }
}
