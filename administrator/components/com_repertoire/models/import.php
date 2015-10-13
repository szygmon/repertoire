<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
require_once 'components/com_repertoire/excel_reader2.php';
/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class RepertoireModelImport extends JModelLegacy {

    /*
     * Metoda do importu utworów z pliku Excel 97-2003
     * @return  true jeśli success, false jeśli error
     */
    public function importSongs() {
        // Neccesary libraries and variables
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');
        
        $jform = JFactory::getApplication()->input->files->get('jform');
        
        $filename = strtolower($jform['excel']['name']);
        $filename = str_replace(
                array('ę', 'ó', 'ą', 'ś', 'ł', 'ż', 'ź', 'ć', 'ń', ' '), array('e', 'o', 'a', 's', 'l', 'z', 'z', 'c', 'n', ''), $filename);
        $filename = JFile::makeSafe($filename);
        $folder = JPATH_SITE . "/" . "images" . "/" . "demomp3";

        // Create the folder if not exists in images folder
        if (!JFolder::exists($folder)) {
            JFolder::create($folder, 0777);
        }

        $src = $jform['excel']['tmp_name'];
        $dest = $folder . "/" . $filename;

        // Obtain a database connection
        $db = JFactory::getDbo();

        if ($jform['excel']['error'] == 0) {
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
            return false;
        }
        // usuwanie pliku z serwera
        JFile::delete($dest);
        return true;
    }

}
