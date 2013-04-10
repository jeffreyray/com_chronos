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
* @subpackage	Study
*/
class ChronosViewStudy extends JView
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
		if (!in_array($layout, array('edit', 'view')))
			return;

		$fct = "display" . ucfirst($layout);
		$this->$fct($tpl);
	}

	/**
	* Execute and display a template : Edit Study
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayEdit($tpl = null)
	{
		$document	= &JFactory::getDocument();
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_EDIT_STUDY") . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'study.edit');
		$this->item		= $item		= $this->get('Item');
		$this->form		= $form		= $this->get('Form');
		$this->canDo	= $canDo	= ChronosHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

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
		require_once(JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php");
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_EDIT_STUDY'), 'chronos_studies');

		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('study.save', "CHRONOS_JTOOLBAR_SAVE");

		// Apply
		if ($item->params->get('access-edit'))
			JToolBarHelper::apply('study.apply', "CHRONOS_JTOOLBAR_APPLY");

		// Cancel
		JToolBarHelper::cancel('study.cancel', "CHRONOS_JTOOLBAR_CANCEL");
		$lists['enum']['studies.tier'] = ChronosHelper::enumList('studies', 'tier');

		$model_client = JModel::getInstance('Clients', 'ChronosModel');
		$model_client->addGroupBy("a.name");
		$lists['fk']['client'] = $model_client->getItems();

		$model_facility = JModel::getInstance('Facilities', 'ChronosModel');
		$model_facility->addGroupBy("a.label");
		$lists['fk']['facility'] = $model_facility->getItems();

		$model_umbrella = JModel::getInstance('Umbrellas', 'ChronosModel');
		$model_umbrella->addGroupBy("a.title");
		$lists['fk']['umbrella'] = $model_umbrella->getItems();

		$model_briefing = JModel::getInstance('Briefings', 'ChronosModel');
		$model_briefing->addGroupBy("a.title");
		$lists['fk']['briefing'] = $model_briefing->getItems();

		//Tier
		$lists['select']['tier'] = new stdClass();
		$lists['select']['tier']->list = $lists['enum']['studies.tier'];
		$lists['select']['tier']->value = $item->tier;

		$model_primary_manager = JModel::getInstance('Projectmanagers', 'ChronosModel');
		$model_primary_manager->addGroupBy("a.display_name");
		$lists['fk']['primary_manager'] = $model_primary_manager->getItems();

		$model_secondary_manager = JModel::getInstance('Projectmanagers', 'ChronosModel');
		$model_secondary_manager->addGroupBy("a.display_name");
		$lists['fk']['secondary_manager'] = $model_secondary_manager->getItems();

		parent::display($tpl);
	}

	/**
	* Execute and display a template : View Study
	*
	* @access	protected
	* @param	string	$tpl	The name of the template file to parse; automatically searches through the template paths.
	*
	* @return	mixed	A string if successful, otherwise a JError object.
	*
	* @since	11.1
	*/
	protected function displayView($tpl = null)
	{
		$document	= &JFactory::getDocument();
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_VIEW_STUDY") . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'study.view');
		$this->item		= $item		= $this->get('Item');
		$this->canDo	= $canDo	= ChronosHelper::getActions($model->getId());
		$lists = array();
		$this->lists = &$lists;

		$user		= JFactory::getUser();
		$isNew		= ($model->getId() == 0);

		//Check ACL before opening the view (prevent from direct access)
		if (!$model->canAccess($item))
		{
			JError::raiseError(500, JText::_('JERROR_ALERTNOAUTHOR'));
			return false;
		}
		$jinput = new JInput;

		//Hide the component menu in item layout
		$jinput->set('hidemainmenu', true);

		//Toolbar initialization
		require_once(JPATH_ADMINISTRATOR .DS. "includes" .DS. "toolbar.php");
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_VIEW_STUDY'), 'chronos_studies');

		// Cancel
		JToolBarHelper::cancel('study.cancel', "CHRONOS_JTOOLBAR_CANCEL");
		$lists['enum']['studies.tier'] = ChronosHelper::enumList('studies', 'tier');



		parent::display($tpl);
	}


}



