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
        // tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . JText::_('COM_REPERTOIRE_EVENTS'), 'stack article');

        if (JFactory::getApplication()->input->get('layout', 'default') == 'list') {
            JToolbarHelper::back();
            JToolbarHelper::apply('event.toprint', 'COM_REPERTOIRE_PRINT');
        } else {
            // przyciski
            JToolBarHelper::addNew('event.add');
            JToolBarHelper::editList('event.edit');
            JToolBarHelper::deleteList(JText::_('COM_REPERTOIRE_CONFIRM_DELETE'), 'events.delete');
        }
        JToolbarHelper::preferences('com_repertoire');
    }

}
