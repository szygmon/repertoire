<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewRepertoire extends JViewLegacy {

    function display($tpl = null) {

        // przypisanie zmiennych dla widoku z modelu
        $this->greeting = $this->get('Greeting');
        $this->rows = $this->get('Repertoire');
        
        $this->params = JComponentHelper::getParams('com_repertoire');///->get('show_category'));//->get('dashboardID'));
        
        parent::display($tpl);
    }

}
