<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireViewEvents extends JViewLegacy {

    function display($tpl = null) {
        $this->rows = $this->get('Repertoire');

        $app = JFactory::getApplication();
        $this->params = $app->getParams();

        if ($app->input->get('layout', 'default') == 'default') {
            if ($this->params->get('pass_text', NULL))
                $passInfo = $this->params->get('pass_text');
            else
                $passInfo = JText::_('COM_REPERTOIRE_EVENTS_INFO');
            $app->enqueueMessage($passInfo, 'notice');
        } else {
            $this->event = $this->get('Event');
        }
        
        // Tytuł strony + przyrostek witryny
        $title = $this->params->get('page_title');
        if (empty($title)) {
            $title = $app->get('sitename');
        } elseif ($app->get('sitename_pagetitles', 0) == 1 && $app->get('sitename') != $title) {
            $title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
        } elseif ($app->get('sitename_pagetitles', 0) == 2 && $app->get('sitename') != $title) {
            $title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
        }

        $this->document->setTitle($title);
        
        parent::display($tpl);
    }
}
