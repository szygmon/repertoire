<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');
require_once 'components/com_repertoire/excel_reader2.php';

class RepertoireModelImport extends JModelLegacy {
    /*
     * Metoda do importu utworów z pliku Excel 97-2003
     * 
     * @return  true jeśli powodzenie, false jeśli błąd
     */
    public function importSongs() {
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');
        
        $jform = JFactory::getApplication()->input->files->get('jform');
        
        $filename = strtolower($jform['excel']['name']);
        $filename = str_replace(
                array('ę', 'ó', 'ą', 'ś', 'ł', 'ż', 'ź', 'ć', 'ń', ' '), array('e', 'o', 'a', 's', 'l', 'z', 'z', 'c', 'n', ''), $filename);
        $filename = JFile::makeSafe($filename);
        
        $folder = JPATH_SITE . "/" . "images" . "/" . "demomp3";

        // Tworzenie folderu jeśli nie istnieje
        if (!JFolder::exists($folder)) {
            JFolder::create($folder, 0777);
        }

        $src = $jform['excel']['tmp_name'];
        $dest = $folder . "/" . $filename;

        $db = JFactory::getDbo();

        // Jeśli nie ma błędu przesłania pliku
        if ($jform['excel']['error'] == 0) {
            JFile::upload($src, $dest);

            $data = new Spreadsheet_Excel_Reader($dest);

            // Czytanie pliku i wpisywanie do BD
            if (count($data->sheets[0][cells]) > 0) { // Sprawdzanie czy arkusz nie jest pusty
                for ($j = 1; $j <= count($data->sheets[0][cells]); $j++) {
                    // Create and populate an object.
                    $song = new stdClass();
                    $song->title = $data->sheets[0][cells][$j][1];
                    $song->artist = $data->sheets[0][cells][$j][2];
                    $song->language = $data->sheets[0][cells][$j][3];

                    $result = JFactory::getDbo()->insertObject('#__repertoire', $song);
                }
            }
        } else {
            // Usuwanie pliku z serwera
            JFile::delete($dest);
            return false;
        }
        // Usuwanie pliku z serwera
        JFile::delete($dest);
        return true;
    }
}
