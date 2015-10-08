<?php

defined('_JEXEC') or die;

class RepertoireHelper extends JHelper {

    public static function addSubmenu($vName) {
        JSubMenuHelper::addEntry(
                JText::_('COM_REPERTOIRE_LIST'), 'index.php?option=com_repertoire', $vName == 'list'
        );
        JSubMenuHelper::addEntry(
                JText::_('COM_REPERTOIRE_CATEGORIES'), 'index.php?option=com_categories&view=categories&extension=com_repertoire', $vName == 'categories'
        );
        JSubMenuHelper::addEntry(
                JText::_('COM_REPERTOIRE_PARTY'), 'index.php?option=com_repertoire&view=party', $vName == 'party');
        JSubMenuHelper::addEntry(
                JText::_('COM_REPERTOIRE_IMPORT'), 'index.php?option=com_repertoire&view=import', $vName == 'import');

        if ($vName == 'categories') {
            $document = JFactory::getDocument();
            $document->setTitle(JText::_('COM_REPERTOIRE') . ": " . JText::_('COM_REPERTOIRE_CATEGORIES'));
        }
    }

}
