<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerSong extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->view_list = 'repertoire'; // przekierowanie po zapisie/edycji...
    }

}
