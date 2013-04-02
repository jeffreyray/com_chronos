<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Employees
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
* @subpackage	Employee
*/
class ChronosViewEmployee extends JView
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
		if (!in_array($layout, array('employee')))
			return;

		$fct = "display" . ucfirst($layout);
		$this->$fct($tpl);
	}

	/**
	* Execute and display a template : Employee
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayEmployee($tpl = null)
	{
		$document	= &JFactory::getDocument();
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_EMPLOYEE") . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'employee.employee');
		$this->item		= $item		= $this->get('Item');
		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ChronosHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check out the item.
		if (!$isNew && !$model->checkout($model->getId()))
		{
			JError::raiseError(500, $model->getError());
			return false;
		}

		//Check ACL before opening the form (prevent from direct access)
		if (!$model->canEdit($item, true))
		{
			JError::raiseError(500, JText::_('JERROR_ALERTNOAUTHOR'));
			return false;
		}
		$jinput = new JInput;

		//Hide the component menu in item layout
		$jinput->set('hidemainmenu', true);

		//Toolbar initialization
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_EMPLOYEE'), 'chronos_employees');

		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('employee.save', "JTOOLBAR_SAVE");

		// Apply
		if ($item->params->get('access-edit'))
			JToolBarHelper::apply('employee.apply', "JTOOLBAR_APPLY");

		// Cancel
		JToolBarHelper::cancel('employee.cancel', "JTOOLBAR_CANCEL");
		$lists['enum']['employees.gender'] = ChronosHelper::enumList('employees', 'gender');

		$lists['enum']['employees.tier'] = ChronosHelper::enumList('employees', 'tier');



		parent::display($tpl);
	}


}



