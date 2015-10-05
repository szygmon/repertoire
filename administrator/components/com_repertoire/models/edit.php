<?php
defined('_JEXEC') or die();
jimport('joomla.application.component.model');
class ZastModelEdit extends JModel
{
	function getZast_e($cid) {
		$query = "SELECT * FROM #__zast WHERE zas_id=".$cid;
		$dane = $this->_getList($query);
		return $dane[0];
	}
}
?>