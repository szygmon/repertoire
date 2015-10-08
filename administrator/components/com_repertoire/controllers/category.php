<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerCategory extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->view_list = 'categories'; // przekierowanie po zapisie/edycji...
    }

}
