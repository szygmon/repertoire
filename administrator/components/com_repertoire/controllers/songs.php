<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_repertoire
 *
 * @copyright   Copyright (C) 2015 Szymon Michalewicz. All rights reserved.
 */

// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

/**
 * The repertoire controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_repertoire
 */
class RepertoireControllerSongs extends JControllerAdmin {
    
    function __construct($config = array()) {
        parent::__construct($config);
        // Zmiana widoku po zapisie/edycji utworu
        $this->view_list = 'repertoire'; 
    }

    /**
     * Proxy for getModel.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  object  The model.
     */
    public function getModel($name = 'Song', $prefix = 'RepertoireModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

    // Obsługa usuwania danych z powiązanych tabel BD
    public function delete() {
        $id = JRequest::getVar('cid');
        
        $this->getModel()->deleteSongs($id);

        parent::delete();
    }
}
