<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class RepertoireController extends JControllerLegacy {

    public function add() {
        $this->setRedirect('index.php?option=com_repertoire&view=add');
    }

    public function edit() {
        $cid = JRequest::getVar('cid'); 
        $this->setRedirect('index.php?option=com_repertoire&view=edit&id='.$cid[0]);
    }
}
?>