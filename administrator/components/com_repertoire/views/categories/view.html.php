<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewCategories extends JViewLegacy {

    protected $form = null;

    function display($tpl = null) {
        // Get the Data
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        $this->addToolbar();

        if ($this->get('layout') != 'edit') {
            RepertoireHelper::addSubmenu('categories');
            $this->sidebar = JHtmlSidebar::render();
        }

        // przypisanie zmiennych dla widoku z modelu
        $this->rows = $this->get('Categories');
        
        parent::display($tpl);
    }

    protected function addToolbar() {
        if ($this->get('layout') == 'edit') {
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
        } else {
            // tytuł strony
            JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . JText::_('COM_REPERTOIRE_LIST'), 'stack article');

            // przyciski
            JToolBarHelper::addNew('categories.add');
            JToolBarHelper::editList('categories.edit');
            JToolBarHelper::deleteList(JText::_('COM_REPERTOIRE_CONFIRM_DELETE_CATEGORIES'), 'categories.del');
            JToolbarHelper::preferences('com_repertoire');
        }
    }

}

?> 