<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireViewSong extends JViewLegacy {

    protected $form = null;

    function display($tpl = null) {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');

        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar() {
        $input = JFactory::getApplication()->input;

        // Blokowanie menu
        $input->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);

        if ($isNew) {
            $title = JText::_('COM_REPERTOIRE_ADD');
        } else {
            $title = JText::_('COM_REPERTOIRE_EDIT');
        }
        // Tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . $title, 'stack article');

        // Przyciski
        JToolBarHelper::save('song.save');
        JToolbarHelper::save2new('song.save2new');
        JToolBarHelper::cancel('song.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
}