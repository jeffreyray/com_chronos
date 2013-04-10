<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	
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
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Component Controller
 *
 * @package		Joomla.Administrator
 * @subpackage	com_content
 */
class ChronosController extends CkJController
{
	/**
	 * @var		string	The default view.
	 * @since	1.6
	 */
	protected $default_view = 'studies';

	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$jinput = new JInput;
		self::addSubMenu(	$jinput->get('view', 'studies', 'STRING'),
							$jinput->get('layout', null, 'STRING'));

		parent::display();

		//If page is called through POST only, reconstruct the url
		if (!isset($_GET['option']))
		{
			//Kill the post and rebuild the url
			$this->setRedirect(ChronosHelper::urlRequest());
			return;
		}

		return $this;
	}

	protected function addSubMenu($view = null, $layout = null)
	{
		JSubMenuHelper::addEntry(JText::_("CHRONOS_VIEW_STUDIES"), 'index.php?option=com_chronos&view=studies', ($view == 'studies'));
		JSubMenuHelper::addEntry(JText::_("CHRONOS_VIEW_FACILITIES"), 'index.php?option=com_chronos&view=facilities', ($view == 'facilities'));
		JSubMenuHelper::addEntry(JText::_("CHRONOS_VIEW_EMPLOYEES"), 'index.php?option=com_chronos&view=employees', ($view == 'employees'));
		JSubMenuHelper::addEntry(JText::_("CHRONOS_VIEW_CLIENTS"), 'index.php?option=com_chronos&view=clients', ($view == 'clients'));
		JSubMenuHelper::addEntry(JText::_("CHRONOS_VIEW_REFERRAL_SOURCES"), 'index.php?option=com_chronos&view=referralsources', ($view == 'referralsources'));
		JSubMenuHelper::addEntry(JText::_("CHRONOS_VIEW_TERMINATION_REASONS"), 'index.php?option=com_chronos&view=terminationreasons', ($view == 'terminationreasons'));
		JSubMenuHelper::addEntry(JText::_("CHRONOS_VIEW_UMBRELLAS"), 'index.php?option=com_chronos&view=umbrellas', ($view == 'umbrellas'));
		JSubMenuHelper::addEntry(JText::_("CHRONOS_VIEW_PRODUCTIVITIES"), 'index.php?option=com_chronos&view=productivities', ($view == 'productivities'));

	}


}
