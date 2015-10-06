<?php
defined('_JEXEC') or die;
require_once(JPATH_COMPONENT.DIRECTORY_SEPARATOR.'controller.php'); 
$classname   = 'RepertoireController';

JLoader::register('RepertoireHelper', __DIR__ . '/helpers/repertoire.php');

$controller   = new $classname( );
$controller->execute( JRequest::getVar('task'));
$controller->redirect();

?> 