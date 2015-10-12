<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerEvents extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        //$this->view_list = 'events'; // przekierowanie po zapisie/edycji...
    }

    // sprawdzanie poprawnego hasła i daty
    public function check() {
        $app = JFactory::getApplication();
        $postData = $app->input->post;

        $cid = $this->getModel()->check($postData->get('date'), $postData->get('pass'));

        if ($cid != NULL) {
            $session = JFactory::getSession();
            $session->set('events', $cid);

            $this->setRedirect('index.php?option=com_repertoire&view=events&layout=mylist&id=' . $cid);
        } else
            $this->setRedirect('index.php?option=com_repertoire&view=events', JText::_('COM_REPERTOIRE_EVENTS_CHECK_ERROR'), 'error');
    }

}
