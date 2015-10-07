<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireController extends JControllerLegacy {

    /**
     * The default view for the display method.
     *
     * @var string
     * @since 12.2
     */
    protected $default_view = 'repertoire';

    /*public function add() {
        $this->setRedirect('index.php?option=com_repertoire&view=add');
    }

    public function edit() {
        $cid = JRequest::getVar('cid');
        $this->setRedirect('index.php?option=com_repertoire&view=edit&id=' . $cid[0]);
    }*/

}
