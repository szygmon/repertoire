<?php
/**
 * @package    Joomla.Tutorials
 * @subpackage Components
 * components/com_hello/hello.php
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_1
 * @license    GNU/GPL
*/
 
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Require the base controller
 
require_once(JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controller.php');
 
/**  index.php?option=com_hello&view=hello&controller=innycontroler
Jesli w request jest przypisany inny controler i plik controllers/innycontroler.php istnieje
require_once $path; == require_once Root/components/com_hello/controllers/innycontroler.php;
*/
/*if($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}*/
 
//  Tworzymy nazwe class'y
$classname    = 'RepertoireController'.$controller;
//  Tworzymy nowy obiekt np. new HelloController(); if empty $controller else HelloControllerinnycontroler();
$controller   = new $classname( );
 
/** if url = index.php?option=com_hello&task=zamknij
Wywoluje funkcje zamknij w com_helo/controller.php */
 
$controller->execute( JRequest::getWord( 'task' ) );
 
// Redirect if set by the controller
$controller->redirect();