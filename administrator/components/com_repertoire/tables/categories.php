<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
class RepertoireTableCategories extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__repertoire_categories', 'id', $db);
	}
}