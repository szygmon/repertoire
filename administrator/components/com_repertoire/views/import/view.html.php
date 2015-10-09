<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewImport extends JViewLegacy {

    protected $form = null;

    function display($tpl = null) {
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));

            return false;
        }

        RepertoireHelper::addSubmenu('import');

        $this->addToolbar();
        $this->sidebar = JHtmlSidebar::render();

        // Info o wymaganiach pliku
        $application = JFactory::getApplication();
        $application->enqueueMessage(JText::_('COM_REPERTOIRE_IMPORT_INFO'), 'notice');
        
        
        parent::display($tpl);
    }

    protected function addToolbar() {
        // tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . JText::_('COM_REPERTOIRE_IMPORT'), 'stack article');

        // przyciski
        JToolBarHelper::apply('import.import', JText::_('COM_REPERTOIRE_IMPORT_NOW'));
        JToolbarHelper::preferences('com_repertoire');
    }

}
