<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerEvents extends JControllerForm {
    // Sprawdzanie poprawnego hasła i daty
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

    // Dodawanie utworów klienta do BD
    public function add() {
        $songs = JRequest::getVar('cid', array(), '', 'array');
        $event = JRequest::getVar('eventid');
        foreach ($songs as $song) {
            $this->getModel()->addSong($song, $event);
        }
        // Czyszczeie sesji po poprawnym dodaniu
        $session = JFactory::getSession();
        $session->clear('events');

        $this->setRedirect('index.php?option=com_repertoire', JText::_('COM_REPERTOIRE_EVENTS_ADD_SUCCESS'));
    }
}
