<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewSong extends JViewLegacy {

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
            $title = JText::_('COM_REPERTOIRE_ADD');
        } else {
            $title = JText::_('COM_REPERTOIRE_EDIT');
        }
        // tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . $title, 'stack article');

        // przyciski
        //JToolbarHelper::apply('song.applay'); ///nie działa???
        JToolBarHelper::save('song.save');
        JToolbarHelper::save2new('song.save2new');
        JToolBarHelper::cancel('song.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }

}

?> 