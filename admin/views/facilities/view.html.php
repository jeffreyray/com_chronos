<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Facilities
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
* @subpackage	Facilities
*/
class ChronosViewFacilities extends JView
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
		if (!in_array($layout, array('default', 'modal', 'ajax')))
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
			case 'filter1':
				$model = $this->getModel();
				$items = $model->getItems();
				/* Ajax Filter : FACILITY > employee
				 * Called from: view:scheduledshifts, layout:default
				 * Group Level : 1
				 */
				//Init or override the list of joined values for entry point
				if (is_array($values) && isset($values[0]) && $values[0])   //First value available
				{
					$model_item = JModel::getInstance('employee', 'ChronosModel');
					$model_item->addJoin("LEFT JOIN chr_facilities AS _facility_ ON _facility_.id = a.facility");
					$model_item->addSelect("a.facility as facility");

					$model_item->setState('employee.id', $values[0]);	//Ground value
					$selectedItem = $model_item->getItem();

					//Redefine the ajax chain key values
					if ($model_item->getId() > 0)
					{
						$values[1] = $selectedItem->facility;

					}

				}
				$selected = (is_array($values))?$values[count($values)-1]:null;

				$ajaxNamespace = "chronos.employees.ajax.filter1";
				$wrapper = "_ajax_employees_$render";
				$event = 'jQuery("#filter_employee").val(""); if(this.value != ""){
						jQuery("#' . $wrapper . '").jdomAjax({namespace:"' . $ajaxNamespace . '", vars:{"filter_facility":this.value}})
						}else{jQuery("#' . $wrapper . '").innerHTML = "";}submitform();';
				echo "<div class='ajaxchain-filter ajaxchain-filter-hz'>";
				echo JDom::_('html.form.input.select', array(
					'dataKey' => 'filter_employee_facility',
					'dataValue' => $selected,
					'formControl' => null,
					'list' => $items,
					'listKey' => 'id',
					'labelKey' => 'label',
					'nullLabel' => "CHRONOS_JSEARCH_SELECT_FACILITY",

					'selectors' => array(
										'onchange' => $event
									)
					));
				echo "</div>";


			//Ajax chain on load -> Follows the values
				echo JDom::_('html.form.input.ajax.chain', array(
					'ajaxWrapper' => $wrapper,
					'ajaxContext' => $ajaxNamespace,
					'ajaxVars' => array(
									'filter_facility' => $selected,
									'values' => $values),
					'ajaxToken' => $token,

					));


			//Wrapper Div
				echo("<div id='" . $wrapper ."' class='ajaxchain-wrapper ajaxchain-wrapper-hz'></div>");
				break;


		}

		jexit();
	}

	/**
	* Execute and display a template : Facilities
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
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_FACILITIES") . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'facilities.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ChronosHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$lists = array();
		$this->lists = &$lists;

		

		//Filters

		//Toolbar initialization
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_FACILITIES'), 'chronos_facilities');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('facility.add', "JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('facility.edit', "JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('CHRONOS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'facility.delete', "JTOOLBAR_DELETE");

		// Config
		if ($model->canAdmin())
			JToolBarHelper::preferences('com_chronos');

		parent::display($tpl);
	}

	/**
	* Execute and display a template : Facilities
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
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_FACILITIES") . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'facilities.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ChronosHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$lists = array();
		$this->lists = &$lists;

		

		//Filters

		//Toolbar initialization
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_FACILITIES'), 'chronos_facilities');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('facility.add', "JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('facility.edit', "JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('CHRONOS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'facility.delete', "JTOOLBAR_DELETE");

		// Config
		if ($model->canAdmin())
			JToolBarHelper::preferences('com_chronos');

		parent::display($tpl);
	}


}



