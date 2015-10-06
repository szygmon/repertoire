<?php
defined('_JEXEC') or die;

class RepertoireHelper extends JHelper
{
	public static $extension = 'com_repertoire';

	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_REPERTOIRE_LIST'),
			'index.php?option=com_repertoire',
			$vName == 'list'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_REPERTOIRE_PARTY'),
			'index.php?option=com_repertoire&view=party',
			$vName == 'party');
	}

}
