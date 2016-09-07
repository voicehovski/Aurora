<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

class AuroraSearchModelListQueries extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	protected function getListQuery()
	{		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,kw,amount');
		$query->from('#__aurora_search_queries');
		return $query;
	}
}