<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewEvent extends JViewLegacy {

    protected $form = null;

    function display($tpl = null) {
        // Get the Data
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');

        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar() {
        $input = JFactory::getApplication()->input;

        // Hide Joomla Administrator Main menu
        $input->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);

        if ($isNew) {
            $title = JText::_('COM_REPERTOIRE_ADD_EVENT');
        } else {
            $title = JText::_('COM_REPERTOIRE_EDIT_EVENT');
        }
        // tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . $title, 'stack article');

        // przyciski
        //JToolbarHelper::apply('song.applay'); ///nie działa???
        JToolBarHelper::save('event.save');
        JToolbarHelper::save2new('event.save2new');
        JToolBarHelper::cancel('event.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }

}

?> 