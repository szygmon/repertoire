<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerEvents extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
    }

    // sprawdzanie poprawnego hasła i daty
    public function check() {
        $app = JFactory::getApplication();
        $postData = $app->input->post;

        $cid = $this->getModel()->check($postData->get('date'), $postData->get('pass'));

        if ($cid != NULL) {
            $session = JFactory::getSession();
            $session->set('events', $cid);

            $this->setRedirect('index.php?option=com_repertoire&view=events&layout=mylist&id=' . $cid, JText::_('COM_REPERTOIRE_EVENTS_YOUR_LIST'));
        } else
            $this->setRedirect('index.php?option=com_repertoire&view=events', JText::_('COM_REPERTOIRE_EVENTS_CHECK_ERROR'), 'error');
    }

    // dodawanie utworów do bazy
    public function add() {
        $songs = JRequest::getVar('cid', array(), '', 'array');
        $event = JRequest::getVar('eventid');
        foreach ($songs as $song) {
            $this->getModel()->addSong($song, $event);
        }
        // zerowanie sesji po poprawnym dodaniu
        $session = JFactory::getSession();
        $session->set('events', 0);

        $this->setRedirect('index.php?option=com_repertoire', JText::_('COM_REPERTOIRE_EVENTS_ADD_SUCCESS'));
    }
}
