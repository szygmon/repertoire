<?php
defined('_JEXEC') or die;
require_once(JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controller.php'); 
$classname   = 'RepertoireController';
$controller   = new $classname( );

$controller->execute( JRequest::getVar('task'));
$controller->redirect();

?> 