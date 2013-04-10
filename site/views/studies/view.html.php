<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Studies
* @copyright	Copyright (c) 2013 Jeffrey Ray Hallock, WB&A Market Research, All rights reserved
* @author		Jeffrey Ray Hallock - mavin.ws - jeffrey.hallock@gmail.com
* @license		GNU/GPL
*
* /!\  Joomla! is free software.
* This version may have been modified pursuant to the GNU General Public License,
* and as distributed it includes or is derivative of works licensed under the
* GNU General Public License or other free or open source software licenses.
*
*             .oooO  Oooo.     See COPYRIGHT.php for copyright notices and details.
*             (   )  (   )
* -------------\ (----) /----------------------------------------------------------- +
*               \_)  (_/
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');


/**
* HTML View class for the Chronos component
*
* @package	Chronos
* @subpackage	Studies
*/
class ChronosViewStudies extends JView
{
	/**
	* Execute and display a template script.
	*
	* @access	public
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	public function display($tpl = null)
	{
		$layout = $this->getLayout();
		if (!in_array($layout, array('default')))
			return;

		$fct = "display" . ucfirst($layout);
		$this->$fct($tpl);
	}

	/**
	* Execute and display a template : Studies
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayDefault($tpl = null)
	{
		$document	= &JFactory::getDocument();
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_STUDIES") . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'studies.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ChronosHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$lists = array();
		$this->lists = &$lists;

		
		$lists['enum']['studies.tier'] = ChronosHelper::enumList('studies', 'tier');


		//Filters
		//Active
		$this->filters['active'] = new stdClass();
		$this->filters['active']->value = $model->getState("filter.active");

		//Facility > Label
		$model_facility = JModel::getInstance('facilities', 'ChronosModel');
		$this->filters['facility'] = new stdClass();
		$this->filters['facility']->list = $model_facility->getItems();
		$this->filters['facility']->value = $model->getState("filter.facility");

		//Client > Name
		$model_client = JModel::getInstance('clients', 'ChronosModel');
		$this->filters['client'] = new stdClass();
		$this->filters['client']->list = $model_client->getItems();
		$this->filters['client']->value = $model->getState("filter.client");

		//start_date
		$this->filters['start_date'] = new stdClass();
		$this->filters['start_date']->from = $model->getState("filter.start_date_from");
		$this->filters['start_date']->to = $model->getState("filter.start_date_to");

		//search_title : search on Title
		$this->filters['search_title'] = new stdClass();
		$this->filters['search_title']->value = $model->getState("search.search_title");

		//search_tags : search on Tags
		$this->filters['search_tags'] = new stdClass();
		$this->filters['search_tags']->value = $model->getState("search.search_tags");


		//Toolbar initialization
		require_once(JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php");
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_STUDIES'), 'chronos_studies');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('study.add', "CHRONOS_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('study.edit', "CHRONOS_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('CHRONOS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'study.delete', "CHRONOS_JTOOLBAR_DELETE");

		parent::display($tpl);
	}


}



