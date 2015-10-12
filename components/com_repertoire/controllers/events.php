<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerEvents extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        //$this->view_list = 'events'; // przekierowanie po zapisie/edycji...
    }

    public function check() {
        $app = JFactory::getApplication();
        $postData = $app->input->post;

        $data = $this->getModel()->check($postData->get('date'), $postData->get('pass'));

        if ($data != NULL) {
            $this->setRedirect('index.php?option=com_repertoire&view=events&layout=mylist&id='.$data->id);
        } else
            $this->setRedirect('index.php?option=com_repertoire&view=events', JText::_('COM_REPERTOIRE_EVENTS_CHECK_ERROR'), 'error');
    }

}
