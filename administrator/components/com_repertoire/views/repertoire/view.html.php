<?php
// Brak bezpośredniego dostępu do pliku
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

        $this->rows = $this->get('Repertoire');

        parent::display($tpl);
    }

    protected function addToolbar() {
        // Tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . JText::_('COM_REPERTOIRE_LIST'), 'stack article');

        // Przyciski
        JToolBarHelper::addNew('song.add');
        JToolBarHelper::editList('song.edit');
        JToolBarHelper::deleteList(JText::_('COM_REPERTOIRE_CONFIRM_DELETE'), 'songs.delete');
        JToolbarHelper::preferences('com_repertoire');
    }
}
