<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Clients
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
* @subpackage	Clients
*/
class ChronosViewClients extends JView
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
			case 'filter2':
				$model = $this->getModel();
				$items = $model->getItems();
				/* Ajax Filter : CLIENT > study
				 * Called from: view:productivities, layout:default
				 * Group Level : 1
				 */
				//Init or override the list of joined values for entry point
				if (is_array($values) && isset($values[0]) && $values[0])   //First value available
				{
					$model_item = JModel::getInstance('study', 'ChronosModel');
					$model_item->addJoin("LEFT JOIN chr_clients AS _client_ ON _client_.id = a.client");
					$model_item->addSelect("a.client as client");

					$model_item->setState('study.id', $values[0]);	//Ground value
					$selectedItem = $model_item->getItem();

					//Redefine the ajax chain key values
					if ($model_item->getId() > 0)
					{
						$values[1] = $selectedItem->client;

					}

				}
				$selected = (is_array($values))?$values[count($values)-1]:null;

				$ajaxNamespace = "chronos.studies.ajax.filter2";
				$wrapper = "_ajax_studies_$render";
				$event = 'jQuery("#filter_study").val(""); if(this.value != ""){
						jQuery("#' . $wrapper . '").jdomAjax({namespace:"' . $ajaxNamespace . '", vars:{"filter_client":this.value}})
						}else{jQuery("#' . $wrapper . '").innerHTML = "";}';
				echo "<div class='ajaxchain-filter ajaxchain-filter-hz'>";
				echo JDom::_('html.form.input.select', array(
					'dataKey' => 'filter_study_client',
					'dataValue' => $selected,
					'formControl' => null,
					'list' => $items,
					'listKey' => 'id',
					'labelKey' => 'name',
					'nullLabel' => "CHRONOS_JSEARCH_SELECT_CLIENT",

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
									'filter_client' => $selected,
									'values' => $values),
					'ajaxToken' => $token,

					));


			//Wrapper Div
				echo("<div id='" . $wrapper ."' class='ajaxchain-wrapper ajaxchain-wrapper-hz'></div>");
				break;

			case 'groupby3':
				$model = $this->getModel();
				$items = $model->getItems();
				/* Ajax Chain : CLIENT > study
				 * Called from: view:productivity, layout:edit
				 * Group Level : 1
				 */
				//Init or override the list of joined values for entry point
				if (is_array($values) && isset($values[0]) && $values[0])   //First value available
				{
					$model_item = JModel::getInstance('study', 'ChronosModel');
					$model_item->addJoin("LEFT JOIN chr_clients AS _client_ ON _client_.id = a.client");
					$model_item->addSelect("a.client as client");

					$model_item->setState('study.id', $values[0]);	//Ground value
					$selectedItem = $model_item->getItem();

					//Redefine the ajax chain key values
					if ($model_item->getId() > 0)
					{
						$values[1] = $selectedItem->client;

					}

				}
				$selected = (is_array($values))?$values[count($values)-1]:null;

				$ajaxNamespace = "chronos.studies.ajax.groupby3";
				$wrapper = "_ajax_studies_$render";
				$event = 'jQuery("#jform_study").val(""); if(this.value != ""){
						jQuery("#' . $wrapper . '").jdomAjax({namespace:"' . $ajaxNamespace . '", vars:{"filter_client":this.value}})
						}else{jQuery("#' . $wrapper . '").innerHTML = "";}';
				echo "<div class='ajaxchain-filter ajaxchain-filter-hz'>";
				echo JDom::_('html.form.input.select', array(
					'dataKey' => 'study_client',
					'dataValue' => $selected,
					'formControl' => 'jform',
					'list' => $items,
					'listKey' => 'id',
					'labelKey' => 'name',
					'nullLabel' => "CHRONOS_JSEARCH_SELECT_CLIENT",

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
									'filter_client' => $selected,
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
	* Execute and display a template : Clients
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
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_CLIENTS") . $document->titleSuffix;

		$this->model		= $model	= $this->getModel();
		$this->state		= $state	= $this->get('State');
		$state->set('context', 'clients.default');
		$this->items		= $items	= $this->get('Items');
		$this->canDo		= $canDo	= ChronosHelper::getActions();
		$this->pagination	= $this->get('Pagination');
		$lists = array();
		$this->lists = &$lists;

		

		//Filters
		//search : search on Name
		$this->filters['search'] = new stdClass();
		$this->filters['search']->value = $model->getState("search.search");


		//Toolbar initialization
		require_once(JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php");
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_CLIENTS'), 'chronos_clients');

		// New
		if ($model->canCreate())
			JToolBarHelper::addNew('client.add', "CHRONOS_JTOOLBAR_NEW");

		// Edit
		if ($model->canEdit())
			JToolBarHelper::editList('client.edit', "CHRONOS_JTOOLBAR_EDIT");

		// Delete
		if ($model->canDelete())
			JToolBarHelper::deleteList(JText::_('CHRONOS_JTOOLBAR_ARE_YOU_SURE_TO_DELETE'), 'client.delete', "CHRONOS_JTOOLBAR_DELETE");

		parent::display($tpl);
	}


}



