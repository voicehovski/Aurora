<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
class AuroraSearchViewAuroraSearch extends JView
{
	function display($tpl = null) 
	{
		$this->rp = $this->get('ParamFromRequest');
		$this->dbp = $this->get('ParamFromDatabase');
		$this->products = $this->get('Products');
		$this->pkw = $this->get('ProbableKeywords');
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}
		
		//In the template set variables, like $this->searchProfile, are available
		parent::display($tpl);
	}
}
