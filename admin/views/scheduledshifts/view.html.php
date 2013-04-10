<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Scheduledshifts
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
* @subpackage	Scheduledshifts
*/
class ChronosViewScheduledshifts extends JView
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
		if (!in_array($layout, array('default', 'modal')))
			return;

		$fct = "display" . ucfirst($layout);
		$this->$fct($tpl);
	}

	/**
	* Execute and display a template : Scheduled Shifts
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
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_SCHEDULED_SHIFTS") . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'scheduledshifts.default');
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

		//Shift Type > Label
		$model_shift_type = JModel::getInstance('shifttypes', 'ChronosModel');
		$this->filters['shift_type'] = new stdClass();
		$this->filters['shift_type']->list = $model_shift_type->getItems();
		$this->filters['shift_type']->value = $model->getState("filter.shift_type");


		//Toolbar initialization
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_SCHEDULED_SHIFTS'), 'chronos_scheduledshifts');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('scheduledshift.add', "JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('scheduledshift.edit', "JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('CHRONOS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'scheduledshift.delete', "JTOOLBAR_DELETE");

		// Config
		if ($model->canAdmin())
			JToolBarHelper::preferences('com_chronos');

		parent::display($tpl);
	}

	/**
	* Execute and display a template : Scheduled Shifts
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayModal($tpl = null)
	{
		$document	= &JFactory::getDocument();
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_SCHEDULED_SHIFTS") . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'scheduledshifts.default');
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

		//Shift Type > Label
		$model_shift_type = JModel::getInstance('shifttypes', 'ChronosModel');
		$this->filters['shift_type'] = new stdClass();
		$this->filters['shift_type']->list = $model_shift_type->getItems();
		$this->filters['shift_type']->value = $model->getState("filter.shift_type");


		//Toolbar initialization
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_SCHEDULED_SHIFTS'), 'chronos_scheduledshifts');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('scheduledshift.add', "JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('scheduledshift.edit', "JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('CHRONOS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'scheduledshift.delete', "JTOOLBAR_DELETE");

		// Config
		if ($model->canAdmin())
			JToolBarHelper::preferences('com_chronos');

		parent::display($tpl);
	}


}



