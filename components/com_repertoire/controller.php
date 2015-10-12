<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireController extends JControllerLegacy {
    // zabezpieczenie przed niepowołanym dostępem - sesja
    public function display($cachable = false, $urlparams = false) {
        if ($this->input->get('layout', 'default') == 'mylist') {
            $getSession = JFactory::getSession();
            $session = $getSession->get('events');
            if (empty($session) || $session == 0 || $session != JRequest::getVar('id')) {
                $getSession->set('events', 0);
                $this->setRedirect('index.php?option=com_repertoire&view=events', JText::_('COM_REPERTOIRE_EVENTS_SESSION_ERROR'), 'error');
            }
        }

        parent::display();

        return $this;
    }

}
