<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireController extends JControllerLegacy {
    // zabezpieczenie przed niepowołanym dostępem - sesja
    public function display($cachable = false, $urlparams = false) {
        if ($this->input->get('layout', 'default') == 'mylist') {
            $session = JFactory::getSession();
            $session = $session->get('events');
            if (empty($session) || $session == 0)
                $this->setRedirect('index.php?option=com_repertoire&view=events', JText::_('COM_REPERTOIRE_EVENTS_SESSION_ERROR'), 'error');
        }

        parent::display();

        return $this;
    }

}
