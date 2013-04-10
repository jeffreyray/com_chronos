<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Referralsources
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
* @subpackage	Referralsource
*/
class ChronosViewReferralsource extends JView
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
	* Execute and display a template : Edit Referral Source
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
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_EDIT_REFERRAL_SOURCE") . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'referralsource.edit');
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
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_EDIT_REFERRAL_SOURCE'), 'chronos_referralsources');

		// Save
		if (($isNew && $model->canCreate()) || (!$isNew && $item->params->get('access-edit')))
			JToolBarHelper::save('referralsource.save', "CHRONOS_JTOOLBAR_SAVE");

		// Apply
		if ($item->params->get('access-edit'))
			JToolBarHelper::apply('referralsource.apply', "CHRONOS_JTOOLBAR_APPLY");

		// Cancel
		JToolBarHelper::cancel('referralsource.cancel', "CHRONOS_JTOOLBAR_CANCEL");
		//Ordering
		$orderModel = JModel::getInstance('Referralsources', 'ChronosModel');
				$lists["ordering"] = $orderModel->getItems();

		parent::display($tpl);
	}

	/**
	* Execute and display a template : View Referral Source
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
		$document->title = $document->titlePrefix . JText::_("CHRONOS_LAYOUT_VIEW_REFERRAL_SOURCE") . $document->titleSuffix;

		// Initialiase variables.
		$this->model	= $model	= $this->getModel();
		$this->state	= $state	= $this->get('State');
		$state->set('context', 'referralsource.view');
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
		JToolBarHelper::title(JText::_('CHRONOS_LAYOUT_VIEW_REFERRAL_SOURCE'), 'chronos_referralsources');

		// Cancel
		JToolBarHelper::cancel('referralsource.cancel', "CHRONOS_JTOOLBAR_CANCEL");


		parent::display($tpl);
	}


}



