<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_repertoire
 *
 * @copyright   Copyright (C) 2015 Szymon Michalewicz. All rights reserved.
 */

// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

/**
 * Events class.
 */
class RepertoireControllerEvents extends JControllerForm {

    // Sprawdzanie poprawnego hasła i daty
    public function check() {
        $app = JFactory::getApplication();
        $postData = $app->input->post;

        $id = $this->getModel()->check($postData->get('date'), $postData->get('pass'));

        if ($id != NULL) {
            $session = JFactory::getSession();
            $session->set('repertoire_for_event', $id);

            $this->setRedirect('index.php?option=com_repertoire&view=events&layout=mylist&id=' . $id, JText::_('COM_REPERTOIRE_EVENTS_YOUR_LIST'));
        } else
            $this->setRedirect('index.php?option=com_repertoire&view=events', JText::_('COM_REPERTOIRE_EVENTS_CHECK_ERROR'), 'error');
    }

    // Dodawanie utworów klienta do BD
    public function add() {
        $songs = JRequest::getVar('cid', array(), '', 'array');
        $getSession = JFactory::getSession();
        $event= $getSession->get('repertoire_for_event');
        $info = JFactory::getApplication()->input->get('info', null, 'HTML');
        foreach ($songs as $song) {
            $this->getModel()->addSong($song, $event);
        }
        if ($info)
            $this->getModel()->addInfo($event, $info);

        // Czyszczeie sesji po poprawnym dodaniu
        $session = JFactory::getSession();
        $session->clear('repertoire_for_event');

        $this->setRedirect('index.php?option=com_repertoire', JText::_('COM_REPERTOIRE_EVENTS_ADD_SUCCESS'));
    }
}
