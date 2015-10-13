<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireViewEvents extends JViewLegacy {

    function display($tpl = null) {
        $this->rows = $this->get('Repertoire');

        $app = JFactory::getApplication();
        $this->params = $app->getParams();

        if ($app->input->get('layout', 'default') == 'default') {
            // Info o wymaganiach pliku
            $app->enqueueMessage(JText::_('COM_REPERTOIRE_EVENTS_INFO'), 'notice');
        } else {
            $this->event = $this->get('Event');
        }
        
        parent::display($tpl);
    }
}
