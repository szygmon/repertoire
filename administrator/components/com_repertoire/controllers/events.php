<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerEvents extends JControllerAdmin {
    
    /**
     * Proxy for getModel.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  object  The model.
     */
    public function getModel($name = 'Event', $prefix = 'RepertoireModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

    // Obsługa usuwania danych z powiązanych tabel BD
    public function delete() {
        $id = JRequest::getVar('cid');

        $this->getModel('Events')->deleteEvents($id);

        parent::delete();
    }
    
    // Obsługa usuwania przestarzałych wydarzeń z BD
    public function deleteold() {
        $this->getModel('Events')->deleteOldEvents();
        $this->setRedirect('index.php?option=com_repertoire&view=events', JText::_('COM_REPERTOIRE_DELETED_OLD_SUCCESS'));
    }
}
