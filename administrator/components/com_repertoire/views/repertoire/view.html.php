<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewRepertoire extends JViewLegacy {

    protected $form = null;

    function display($tpl = null) {
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));

            return false;
        }

        RepertoireHelper::addSubmenu('list');

        $this->addToolbar();
        $this->sidebar = JHtmlSidebar::render();

        // przypisanie zmiennych dla widoku z modelu
        $this->rows = $this->get('Repertoire')['rows'];
        $this->count = $this->get('Repertoire')['count'];

        parent::display($tpl);
    }

    protected function addToolbar() {
        // tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . JText::_('COM_REPERTOIRE_LIST'), 'stack article');

        // przyciski
        JToolBarHelper::addNew('song.add');
        JToolBarHelper::editList('song.edit');
        JToolBarHelper::deleteList(JText::_('COM_REPERTOIRE_CONFIRM_DELETE'), 'songs.delete');
        JToolbarHelper::preferences('com_repertoire');
    }

}
