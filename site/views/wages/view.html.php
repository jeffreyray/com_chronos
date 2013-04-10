<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Wages
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
* @subpackage	Wages
*/
class ChronosViewWages extends JView
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
	* Execute and display a template : Wages
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
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_WAGES") . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'wages.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ChronosHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$lists = array();
		$this->lists = &$lists;

		

		//Filters
		//Ajax call : Employee > Number
		$model_employee = JModel::getInstance('employee', 'ChronosModel');
		$this->filters['employee']->values = array(
		$model->getState("filter.employee"),
		$model->getState("filter.employee_facility"),

		);

		//Reason > Label
		$model_reason = JModel::getInstance('wagereasons', 'ChronosModel');
		$this->filters['reason'] = new stdClass();
		$this->filters['reason']->list = $model_reason->getItems();
		$this->filters['reason']->value = $model->getState("filter.reason");

		//date_effective
		$this->filters['date_effective'] = new stdClass();
		$this->filters['date_effective']->from = $model->getState("filter.date_effective_from");
		$this->filters['date_effective']->to = $model->getState("filter.date_effective_to");

		//seach_comment : search on Comment
		$this->filters['seach_comment'] = new stdClass();
		$this->filters['seach_comment']->value = $model->getState("search.seach_comment");


		//Toolbar initialization
		require_once(JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php");
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_WAGES'), 'chronos_wages');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('wage.add', "CHRONOS_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('wage.edit', "CHRONOS_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('CHRONOS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'wage.delete', "CHRONOS_JTOOLBAR_DELETE");

		parent::display($tpl);
	}


}



