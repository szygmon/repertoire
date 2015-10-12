<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewEvents extends JViewLegacy {

    //protected $form = null;

    function display($tpl = null) {
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));

            return false;
        }

        RepertoireHelper::addSubmenu('events');

        $this->addToolbar();
        $this->sidebar = JHtmlSidebar::render();

        // przypisanie zmiennych dla widoku z modelu
        $this->rows = $this->get('Events');

        parent::display($tpl);
    }

    protected function addToolbar() {
        // tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . JText::_('COM_REPERTOIRE_EVENTS'), 'stack article');

        // przyciski
        JToolBarHelper::addNew('event.add');
        JToolBarHelper::editList('event.edit');
        JToolBarHelper::deleteList(JText::_('COM_REPERTOIRE_CONFIRM_DELETE'), 'events.delete');
        JToolbarHelper::preferences('com_repertoire');
    }

}
