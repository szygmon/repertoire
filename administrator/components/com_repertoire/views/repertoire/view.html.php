<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');

class RepertoireViewRepertoire extends JViewLegacy {
	function display($tpl = null) {
		global $option;
		JSubMenuHelper::addEntry('Lista', 'index.php?option=com_zast', true);
		JsubMenuHelper::addEntry('Dodaj zastępstwa', 'index.php?option=com_zast&amp;view=add', false);
				
                JToolbarHelper::title(JText::_('COM_REPERTOIRE_LIST'), 'stack article');
		JToolBarHelper::addNew('addNew', 'Dodaj');
		JToolBarHelper::editList('editabs', 'Edytuj');
		JToolBarHelper::deleteList('Na pewno usunąć?', 'del');
		JToolBarHelper::cancel('close', 'Zamknij');
		
                $model = $this->getModel();
		$this->assignRef('rows', $model->getRepertoire()['rows']);
                $this->assignRef('count', $model->getRepertoire()['count']);
		
                parent::display($tpl);
	}
}

?> 