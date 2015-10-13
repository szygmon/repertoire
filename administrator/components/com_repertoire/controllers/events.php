<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerEvents extends JControllerAdmin {

    public function __construct($config = array()) {
        parent::__construct($config);
        //$this->view_list = 'repertoire'; // przekierowanie po zapisie/edycji...
    }

    /**
     * Proxy for getModel.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  object  The model.
     *
     * @since   1.6
     */
    public function getModel($name = 'Event', $prefix = 'RepertoireModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

    public function delete() {
        $id = JRequest::getVar('cid');

        $this->getModel('Events')->deleteEvents($id);

        parent::delete();
    }

}
