<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerSongs extends JControllerAdmin {

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->view_list = 'repertoire'; // przekierowanie po zapisie/edycji...
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
    public function getModel($name = 'Song', $prefix = 'RepertoireModel', $config = array('ignore_request' => true)) {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

    public function delete() {
        // Neccesary libraries and variables
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $folder = JPATH_SITE . "/" . "images" . "/" . "demomp3";

        $id = JRequest::getVar('cid');
        $idq = implode($id, ',');
        $db = JFactory::getDBO();
        $query = $db->getQuery(true)
                ->select('demo_audio')
                ->from($db->quoteName('#__repertoire'))
                ->where('id IN (' . $idq . ') AND demo_audio != ""');
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $result = $db->loadRowList();

        foreach ($result as $row) {
            // usuwanie pliku z serwera
            JFile::delete($folder . "/" . $row[0]);
        }

        parent::delete();
    }

}
