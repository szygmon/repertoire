<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireViewEvent extends JViewLegacy {

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

        // Wyłączanie menu
        $input->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);

        if ($isNew) {
            $title = JText::_('COM_REPERTOIRE_ADD_EVENT');
        } else {
            $title = JText::_('COM_REPERTOIRE_EDIT_EVENT');
        }
        // Tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . $title, 'stack article');

        // Przyciski
        JToolBarHelper::save('event.save');
        JToolbarHelper::save2new('event.save2new');
        JToolBarHelper::cancel('event.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
}

?> 