<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die;

abstract class RepertoireHelper {
    // Sidebar
    public static function addSubmenu($vName) {
        JHtmlSidebar::addEntry(
                JText::_('COM_REPERTOIRE_LIST'), 'index.php?option=com_repertoire', $vName == 'list'
        );
        JHtmlSidebar::addEntry(
                JText::_('COM_REPERTOIRE_CATEGORIES'), 'index.php?option=com_categories&view=categories&extension=com_repertoire', $vName == 'categories'
        );
        JHtmlSidebar::addEntry(
                JText::_('COM_REPERTOIRE_EVENTS'), 'index.php?option=com_repertoire&view=events', $vName == 'events'
        );
        JHtmlSidebar::addEntry(
                JText::_('COM_REPERTOIRE_IMPORT'), 'index.php?option=com_repertoire&view=import', $vName == 'import'
        );
    }
}
