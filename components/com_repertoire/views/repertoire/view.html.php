<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireViewRepertoire extends JViewLegacy {

    function display($tpl = null) {

        // przypisanie zmiennych dla widoku z modelu
        //$this->greeting = $this->get('Greeting');
        $this->rows = $this->get('Repertoire');

        $app = JFactory::getApplication();
        $this->params = $app->getParams(); ///->get('show_category'));//->get('dashboardID'));

        parent::display($tpl);
    }

}
