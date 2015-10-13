<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class RepertoireModelSong extends JModelAdmin {

    /**
     * Method to get a table object, load it if necessary.
     *
     * @param   string  $type    The table name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  JTable  A JTable object
     *
     * @since   1.6
     */
    public function getTable($type = 'Repertoire', $prefix = 'RepertoireTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to get the record form.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed    A JForm object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm(
                'com_repertoire.song', 'song', array(
            'control' => 'jform',
            'load_data' => $loadData
                )
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData() {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(
                'com_repertoire.edit.song.data', array()
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    /*
     * Metoda do zapisu piosenki w repertuarze
     * 
     * @param   int     $songid     ID utworu (0 dla nowo dodawanego
     * @param   JFactory::getApplication()->input->files->get('jform')
     * @param   boolean $deletefile 1 - dla pozostawienia pliku, 0 - dla usunięcia pliku z serwera
     * 
     */
    public function saveSong($songid, $file, $deletefile = 1) {
        // Neccesary libraries and variables
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        // nazwa pliku - małe znaki, usuwanie pl znaków i spacji, bezpieczna nazwa
        $filename = strtolower($file['mp3']['name']);
        $filename = str_replace(
                array('ę', 'ó', 'ą', 'ś', 'ł', 'ż', 'ź', 'ć', 'ń', ' '), array('e', 'o', 'a', 's', 'l', 'z', 'z', 'c', 'n', ''), $filename);
        $filename = JFile::makeSafe($filename);
        $folder = JPATH_SITE . "/" . "images" . "/" . "demomp3";

        // Create the folder if not exists in images folder
        if (!JFolder::exists($folder)) {
            JFolder::create($folder, 0777);
        }

        $src = $file['mp3']['tmp_name'];
        $dest = $folder . "/" . $filename;

        // Obtain a database connection
        $db = JFactory::getDbo();

        if ($file['mp3']['error'] == 0) {
            JFile::upload($src, $dest);

            if ($songid != 0) {
                $query = $db->getQuery(true)
                        ->update($db->quoteName('#__repertoire'))
                        ->set('demo_audio = "' . $filename . '"')
                        ->where('id=' . $songid);

                $db->setQuery($query);
                $db->execute();
            } else {
                // szukanie ostatnio dodanego id utworu
                $query = $db->getQuery(true)
                        ->select('id')
                        ->from($db->quoteName('#__repertoire'))
                        ->order('id DESC')
                        ->setLimit(1);

                // Prepare the query
                $db->setQuery($query);
                // Load the row.
                $result = $db->loadRow();

                $query = $db->getQuery(true)
                        ->update($db->quoteName('#__repertoire'))
                        ->set('demo_audio = "' . $filename . '"')
                        ->where('id=' . $result[0]);

                $db->setQuery($query);
                $db->execute();
            }
        }
        // usuwanie mp3 - uwaga! dla 0 usuwamy! trik zastosowany dla kolorowania przycisku Usuń (Tak) na czerwono w Joomla
        if ($deletefile == 0) {
            $query = $db->getQuery(true)
                    ->select('demo_audio')
                    ->from($db->quoteName('#__repertoire'))
                    ->where('id=' . $songid)
                    ->setLimit(1);

            // Prepare the query
            $db->setQuery($query);
            // Load the row.
            $result = $db->loadRow();

            // usuwanie pliku z serwera
            JFile::delete($folder . "/" . $result[0]);

            // usuwanie wpisu w BD
            $query = $db->getQuery(true)
                    ->update($db->quoteName('#__repertoire'))
                    ->set('demo_audio = ""')
                    ->where('id=' . $songid);

            $db->setQuery($query);
            $db->execute();
        }
    }

}
