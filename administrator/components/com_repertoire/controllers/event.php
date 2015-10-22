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
class RepertoireControllerEvent extends JControllerForm {

    // Przekierowanie do widoku do druku
    public function toprint() {
        $id = JRequest::getVar('id');
        $this->setRedirect('index.php?option=com_repertoire&view=events&layout=list&tmpl=component&print=1&id='.$id);
    }
}
