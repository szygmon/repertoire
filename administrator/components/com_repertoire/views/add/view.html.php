<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewAdd extends JViewLegacy {

    protected $items;
    protected $pagination;

    function display($tpl = null) {
        // Get the Data
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        $this->addToolbar();
        //$this->sidebar = JHtmlSidebar::render();

        parent::display($tpl);
    }

    protected function addToolbar() {

        // tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . JText::_('COM_REPERTOIRE_ADD'), 'stack article');

        $isNew = ($this->item->id == 0);
        
        // przyciski
        JToolBarHelper::save('save');
        JToolBarHelper::cancel('cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
        JToolBarHelper::deleteList('Na pewno usunąć?', 'del');
        JToolbarHelper::preferences('com_repertoire');
    }

}

?> 