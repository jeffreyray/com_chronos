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
* @subpackage	Employees
*/
class ChronosViewEmployees extends JView
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
		if (!in_array($layout, array('default', 'ajax')))
			return;

		$fct = "display" . ucfirst($layout);
		$this->$fct($tpl);
	}

	/**
	* Execute and display ajax queries
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayAjax($tpl = null)
	{
		$jinput = new JInput;
		$render = $jinput->get('render', null, 'CMD');
		$token = $jinput->get('token', null, 'BASE64');
		$values = $jinput->get('values', null, 'ARRAY');



		switch($render)
		{
			case 'groupby1':
				$model = $this->getModel();
				$items = $model->getItems();
				/* Ajax Chain : facility > REFERRER
				 * Called from: view:employee, layout:edit
				 * Group Level : 0
				 */

				$selected = (is_array($values))?$values[count($values)-1]:null;


				$event = 'jQuery("#jform_referrer").val(this.value);';
				echo "<div class='ajaxchain-filter ajaxchain-filter-hz'>";
				echo "<div class='separator'>";
				echo JDom::_('html.form.input.select', array(
					'dataKey' => '__ajx_referrer',
					'dataValue' => $selected,
					'formControl' => 'jform',
					'list' => $items,
					'listKey' => 'id',
					'labelKey' => 'number',
					'nullLabel' => "CHRONOS_JSEARCH_SELECT_REFERRER",

					'selectors' => array(
										'onchange' => $event
									)
					));
				echo "</div>";
				echo "</div>";



				break;

			case 'filter1':
				$model = $this->getModel();
				$items = $model->getItems();
				/* Ajax Filter : facility > EMPLOYEE
				 * Called from: view:productivities, layout:default
				 * Group Level : 0
				 */

				$selected = (is_array($values))?$values[count($values)-1]:null;


				$event = 'jQuery("#filter_employee").val(this.value);submitform();';
				echo "<div class='ajaxchain-filter ajaxchain-filter-hz'>";
				echo "<div class='separator'>";
				echo JDom::_('html.form.input.select', array(
					'dataKey' => '__ajx_employee',
					'dataValue' => $selected,
					'formControl' => null,
					'list' => $items,
					'listKey' => 'id',
					'labelKey' => 'number',
					'nullLabel' => "CHRONOS_JSEARCH_SELECT_EMPLOYEE",

					'selectors' => array(
										'onchange' => $event
									)
					));
				echo "</div>";
				echo "</div>";



				break;

			case 'groupby2':
				$model = $this->getModel();
				$items = $model->getItems();
				/* Ajax Chain : facility > EMPLOYEE
				 * Called from: view:productivity, layout:edit
				 * Group Level : 0
				 */

				$selected = (is_array($values))?$values[count($values)-1]:null;


				$event = 'jQuery("#jform_employee").val(this.value);';
				echo "<div class='ajaxchain-filter ajaxchain-filter-hz'>";
				echo "<div class='separator'>";
				echo JDom::_('html.form.input.select', array(
					'dataKey' => '__ajx_employee',
					'dataValue' => $selected,
					'formControl' => 'jform',
					'list' => $items,
					'listKey' => 'id',
					'labelKey' => 'number',
					'nullLabel' => "CHRONOS_JSEARCH_SELECT_EMPLOYEE",

					'selectors' => array(
										'onchange' => $event
									)
					));
				echo "</div>";
				echo "</div>";



				break;


		}

		jexit();
	}

	/**
	* Execute and display a template : Employees
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
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_EMPLOYEES") . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'employees.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ChronosHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$lists = array();
		$this->lists = &$lists;

		
		$lists['enum']['employees.gender'] = ChronosHelper::enumList('employees', 'gender');

		$lists['enum']['employees.tier'] = ChronosHelper::enumList('employees', 'tier');


		//Filters
		//Facility > Label
		$model_facility = JModel::getInstance('facilities', 'ChronosModel');
		$this->filters['facility'] = new stdClass();
		$this->filters['facility']->list = $model_facility->getItems();
		$this->filters['facility']->value = $model->getState("filter.facility");

		//Position > Label
		$model_position = JModel::getInstance('positions', 'ChronosModel');
		$this->filters['position'] = new stdClass();
		$this->filters['position']->list = $model_position->getItems();
		$this->filters['position']->value = $model->getState("filter.position");

		//search_name : search on First Name
		$this->filters['search_name'] = new stdClass();
		$this->filters['search_name']->value = $model->getState("search.search_name");

		//Active
		$this->filters['active'] = new stdClass();
		$this->filters['active']->value = $model->getState("filter.active");


		//Toolbar initialization
		require_once(JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php");
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_EMPLOYEES'), 'chronos_employees');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('employee.add', "CHRONOS_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('employee.edit', "CHRONOS_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('CHRONOS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'employee.delete', "CHRONOS_JTOOLBAR_DELETE");

		parent::display($tpl);
	}


}



