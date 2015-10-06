<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');

class RepertoireViewRepertoire extends JViewLegacy {

    protected $items;
    protected $pagination;

    function display($tpl = null) {
        //global $option;
        RepertoireHelper::addSubmenu('list');

        $this->addToolbar();
        $this->sidebar = JHtmlSidebar::render();


        $model = $this->getModel();
        $this->assignRef('rows', $model->getRepertoire()['rows']);
        $this->assignRef('count', $model->getRepertoire()['count']);

        parent::display($tpl);
    }

    protected function addToolbar() {

        // tytuł strony
        JToolbarHelper::title(JText::_('COM_REPERTOIRE') . ': ' . JText::_('COM_REPERTOIRE_LIST'), 'stack article');

        // przyciski
        JToolBarHelper::addNew('addNew');
        JToolBarHelper::editList('editabs');
        JToolBarHelper::deleteList('Na pewno usunąć?', 'del');
        JToolbarHelper::preferences('com_repertoire');
    }

}

?> 