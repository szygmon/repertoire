<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerSong extends JControllerForm {
    /* function display($cachable = false, $urlparams = array()) {
      $this->view_item = "repertoire";
      }
      protected $default_view = 'repertoire';
    
*/
    public function cancel() {
        $this->setRedirect('index.php?option=com_repertoire', $this->message);
    }

    /*public function save() {
        $this->setRedirect('index.php?option=com_repertoire', "Aaaaaaa");
    }*/
}
