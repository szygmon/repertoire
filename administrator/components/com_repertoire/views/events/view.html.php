<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireViewEvents extends JViewLegacy {
    function display($tpl = null) {
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));

            return false;
        }

        $this->print = JRequest::getVar('print', false);

        $this->addToolbar();
        if (!$this->print) {
            RepertoireHelper::addSubmenu('events');
            $this->sidebar = JHtmlSidebar::render();
        }

        $app = JFactory::getApplication();
        if ($app->input->get('layout', 'default') == 'list') {
            $this->rows = $this->getModel()->getSongs(JRequest::getVar('id'));
        } else {
            $this->rows = $this->get('Events');
        }

        parent::display($tpl);
    }

    protected function addToolbar() {
        // Tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . JText::_('COM_REPERTOIRE_EVENTS'), 'stack article');

        // Przyciski
        if (JFactory::getApplication()->input->get('layout', 'default') == 'list') {
            JToolbarHelper::back();
            JToolbarHelper::apply('event.toprint', 'COM_REPERTOIRE_PRINT');
        } else {
            JToolBarHelper::addNew('event.add');
            JToolBarHelper::editList('event.edit');
            JToolBarHelper::deleteList(JText::_('COM_REPERTOIRE_CONFIRM_DELETE'), 'events.delete');
            JToolBarHelper::custom('events.deleteold', 'delete', '', JText::_('COM_REPERTOIRE_DELETE_OLD'), false);
                    //(JText::_('COM_REPERTOIRE_CONFIRM_DELETE_OLD'), 'events.deleteold', JText::_('COM_REPERTOIRE_DELETE_OLD'));
        }
        JToolbarHelper::preferences('com_repertoire');
    }
}
