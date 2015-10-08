<?php

defined('_JEXEC') or die;

abstract class RepertoireHelper {

    public static function addSubmenu($vName) {
        JHtmlSidebar::addEntry(
                JText::_('COM_REPERTOIRE_LIST'), 'index.php?option=com_repertoire', $vName == 'list'
        );
        JHtmlSidebar::addEntry(
                JText::_('COM_REPERTOIRE_CATEGORIES'), 'index.php?option=com_categories&view=categories&extension=com_repertoire', $vName == 'categories'
        );
        JHtmlSidebar::addEntry(
                JText::_('COM_REPERTOIRE_PARTY'), 'index.php?option=com_repertoire&view=party', $vName == 'party');
        JHtmlSidebar::addEntry(
                JText::_('COM_REPERTOIRE_IMPORT'), 'index.php?option=com_repertoire&view=import', $vName == 'import');

        if ($vName == 'categories') {
            $document = JFactory::getDocument();
            $document->setTitle(JText::_('COM_REPERTOIRE') . ": " . JText::_('COM_REPERTOIRE_CATEGORIES'));
        }
    }

}
