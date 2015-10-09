<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
require_once 'components/com_repertoire/excel_reader2.php';

class RepertoireControllerImport extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        //$this->view_list = 'repertoire'; // przekierowanie po zapisie/edycji...
    }

    public function import() {
        // Neccesary libraries and variables
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $input = JFactory::getApplication()->input;
        $file = $input->files->get('jform');
        $filename = strtolower($file['excel']['name']);
        $filename = str_replace(
                array('ę', 'ó', 'ą', 'ś', 'ł', 'ż', 'ź', 'ć', 'ń', ' '), array('e', 'o', 'a', 's', 'l', 'z', 'z', 'c', 'n', ''), $filename);
        $filename = JFile::makeSafe($filename);
        $folder = JPATH_SITE . "/" . "images" . "/" . "demomp3";

        // Create the folder if not exists in images folder
        if (!JFolder::exists($folder)) {
            JFolder::create($folder, 0777);
        }

        $src = $file['excel']['tmp_name'];
        $dest = $folder . "/" . $filename;

        // Obtain a database connection
        $db = JFactory::getDbo();

        if ($file['excel']['error'] == 0) {
            JFile::upload($src, $dest);

            $data = new Spreadsheet_Excel_Reader($dest);

            // czytanie pliku i wpisywanie do BD
            if (count($data->sheets[0][cells]) > 0) {// checking sheet not empty
                for ($j = 1; $j <= count($data->sheets[0][cells]); $j++) {// loop used to get each row of the sheet
                    // Create and populate an object.
                    $song = new stdClass();
                    $song->title = $data->sheets[0][cells][$j][1];
                    $song->artist = $data->sheets[0][cells][$j][2];
                    $song->language = $data->sheets[0][cells][$j][3];

                    // Insert the object into the user profile table.
                    $result = JFactory::getDbo()->insertObject('#__repertoire', $song);
                }
            }
        } else {
            // usuwanie pliku z serwera
            JFile::delete($dest);
            // przekierowanie z wiadomością
            $this->setRedirect('index.php?option=com_repertoire', JText::_('COM_REPERTOIRE_IMPORT_ERROR'));
        }
        // usuwanie pliku z serwera
        JFile::delete($dest);
        // przekierowanie z wiadomością
        $this->setRedirect('index.php?option=com_repertoire', JText::_('COM_REPERTOIRE_IMPORT_SUCCESS'));
    }

}
