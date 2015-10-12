<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewEvents extends JViewLegacy {

    function display($tpl = null) {

        // przypisanie zmiennych dla widoku z modelu
        $this->rows = $this->get('Repertoire');

        $app = JFactory::getApplication();
        $this->params = $app->getParams(); 
        
        // Info o wymaganiach pliku
        $application = JFactory::getApplication();
        $application->enqueueMessage(JText::_('COM_REPERTOIRE_EVENTS_INFO'), 'notice');

        parent::display($tpl);
    }

}
