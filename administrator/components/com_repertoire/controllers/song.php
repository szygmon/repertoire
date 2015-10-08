<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class RepertoireControllerSong extends JControllerForm {

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->view_list = 'repertoire'; // przekierowanie po zapisie/edycji...
    }

    public function save($key = null, $urlVar = null) {
        // Neccesary libraries and variables
        jimport('joomla.filesystem.folder');
        jimport('joomla.filesystem.file');

        $input = JFactory::getApplication()->input;
        $file = $input->files->get('jform');
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

        // wywołanie rodzica
        parent::save($key, $urlVar);

        if ($file['mp3']['error'] == 0) {
            JFile::upload($src, $dest);

            // Obtain a database connection
            $db = JFactory::getDbo();
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
                    ->set('demo = "' . $filename . '"')
                    ->where('id=' . $result[0]);
            // Prepare the query
            $db->setQuery($query);

            $db->execute();
        }
    }

}
