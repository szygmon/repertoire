<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class RepertoireViewRepertoire extends JViewLegacy {

    function display($tpl = null) {
        $model = $this->getModel();
        $greeting = $model->getGreeting();
        $this->assignRef('greeting', $greeting);


        $this->assignRef('rows', $model->getRepertoire()['rows']);
        $this->assignRef('count', $model->getRepertoire()['count']);

        parent::display($tpl);
    }

}
