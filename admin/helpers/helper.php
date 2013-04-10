<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Viewlevels
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

if (!class_exists('JDom'))
	require_once(JPATH_ADMIN_CHRONOS .DS.'dom'.DS.'dom.php');
jimport('joomla.application.input');
cimport('helpers.mvc');


/**
* Chronos Helper functions.
*
* @package	Chronos
* @subpackage	Helper
*/
class ChronosHelper
{
	/**
	* Cache for ACL actions
	*
	* @var object
	*/
	protected static $acl = null;

	/**
	* Prepare the enumeration static lists.
	*
	* @access	public static
	* @param	string	$ctrl	The model in wich to find the list.
	* @param	string	$fieldName	The field reference for this list.
	*
	* @return	array	Prepared arrays to fill lists.
	*/
	public static function enumList($ctrl, $fieldName)
	{
		$lists = array();

		$lists["studies"]["tier"] = array();
		$lists["studies"]["tier"]["1"] = array("value" => "1", "text" => JText::_("CHRONOS_ENUM_STUDIES_TIER_TIER_1"));
		$lists["studies"]["tier"]["2"] = array("value" => "2", "text" => JText::_("CHRONOS_ENUM_STUDIES_TIER_TIER_2"));
		$lists["studies"]["tier"]["3"] = array("value" => "3", "text" => JText::_("CHRONOS_ENUM_STUDIES_TIER_TIER_3"));
		$lists["studies"]["tier"]["4"] = array("value" => "4", "text" => JText::_("CHRONOS_ENUM_STUDIES_TIER_TIER_4"));


		$lists["employees"]["gender"] = array();
		$lists["employees"]["gender"]["f"] = array("value" => "f", "text" => JText::_("CHRONOS_ENUM_EMPLOYEES_GENDER_FEMALE"));
		$lists["employees"]["gender"]["m"] = array("value" => "m", "text" => JText::_("CHRONOS_ENUM_EMPLOYEES_GENDER_MALE"));


		$lists["employees"]["tier"] = array();
		$lists["employees"]["tier"]["1"] = array("value" => "1", "text" => JText::_("CHRONOS_ENUM_EMPLOYEES_TIER_1"));
		$lists["employees"]["tier"]["2"] = array("value" => "2", "text" => JText::_("CHRONOS_ENUM_EMPLOYEES_TIER_2"));
		$lists["employees"]["tier"]["3"] = array("value" => "3", "text" => JText::_("CHRONOS_ENUM_EMPLOYEES_TIER_3"));
		$lists["employees"]["tier"]["4"] = array("value" => "4", "text" => JText::_("CHRONOS_ENUM_EMPLOYEES_TIER_4"));


		$lists["productivities"]["source"] = array();
		$lists["productivities"]["source"]["1"] = array("value" => "1", "text" => JText::_("CHRONOS_ENUM_PRODUCTIVITIES_SOURCE_CATI"));
		$lists["productivities"]["source"]["2"] = array("value" => "2", "text" => JText::_("CHRONOS_ENUM_PRODUCTIVITIES_SOURCE_PAPER"));




		return $lists[$ctrl][$fieldName];
	}

	/**
	* Gets a list of the actions that can be performed.
	*
	* @access	public static
	*
	* @return	JObject	An ACL object containing authorizations
	*
	* @deprecated	Cook 2.0
	*/
	public static function getAcl()
	{
		return self::getActions();
	}

	/**
	* Gets a list of the actions that can be performed.
	*
	* @access	public static
	* @param	integer	$itemId	The item ID.
	*
	* @return	JObject	An ACL object containing authorizations
	*
	* @since	1.6
	*/
	public static function getActions($itemId = 0)
	{
		if (isset(self::$acl))
			return self::$acl;

		$user	= JFactory::getUser();
		$result	= new JObject;

		$actions = array(
			'core.admin',
			'core.manage',
			'core.create',
			'core.edit',
			'core.edit.state',
			'core.edit.own',
			'core.delete',
			'core.delete.own',
		);

		foreach ($actions as $action)
			$result->set($action, $user->authorise($action, COM_CHRONOS));

		self::$acl = $result;

		return $result;
	}

	/**
	* Defines the headers of your template.
	*
	* @access	public static
	*
	* @return	void	
	* @return	void
	*/
	public static function headerDeclarations()
	{
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();

		$siteUrl = JURI::root(true);

		$componentUrl = $siteUrl . '/components/com_chronos';
		$componentUrlAdmin = $siteUrl .'/administrator/components/com_chronos';


		//Javascript
		$doc->addScript($siteUrl . '/media/system/js/core.js');
		// Mootools non conflict is handled here :
		$doc->addScriptDeclaration("var Moo = document.id;");

		//$doc->addScript($componentUrlAdmin . '/js/jquery-1.8.2.min.js');
		$doc->addScript($componentUrlAdmin . '/js/jquery-ui-1.9.1.min.js');

		//Load the jQuery-Validation-Engine (MIT License, Copyright(c) 2011 Cedric Dugas http://www.position-absolute.com)
		$doc->addScript($componentUrlAdmin . '/js/jquery.validationEngine.js');
		$doc->addStyleSheet($componentUrlAdmin . '/css/validationEngine.jquery.css');
		cimport('helpers.html.validator');
		JHtmlValidator::loadLanguageScript();

		//TODO : Define here the default framework to use with $
		// Mootools is still used in Joomla native javascript functionalities
		$doc->addScriptDeclaration("var $" . " = Moo;");  //Moo ; jQuery

		/*
		 * How to write a plugins in non-conflict modes :
		 *
		 (function($){
		// Write your code here, using $.
		// The local var $ represents jQuery framework
		})(jQuery);


		// exactly the same, with for MooTools plugins
		 (function($){
		...
		})(Moo);

		 */


		//CSS
		if ($app->isAdmin())
		{
			$doc->addStyleSheet($componentUrlAdmin . '/css/chronos.css');
			$doc->addStyleSheet($componentUrlAdmin . '/css/toolbar.css');
			$doc->addStyleSheet($componentUrlAdmin . '/css/jquery-ui-1.9.1.min.css');
			// Blue stork override
			$styles = "fieldset td.key label{display: block;}fieldset input, fieldset textarea, fieldset select, fieldset img, fieldset button{float: none;}fieldset label, fieldset span.faux-label{float: none;display: inline;min-width: inherit;}";
			$doc->addStyleDeclaration($styles);

		}
		else if ($app->isSite())
		{
			$doc->addStyleSheet($componentUrl . '/css/chronos.css');
			$doc->addStyleSheet($componentUrl . '/css/toolbar.css');
			$doc->addStyleSheet($componentUrl . '/css/jquery-ui-1.9.1.min.css');
		}


	}

	/**
	* Recreate the URL with a redirect in order to : -> keep an good SEF ->
	* always kill the post -> precisely control the request
	*
	* @access	public static
	* @param	array	$vars	The array to override the current request.
	*
	* @return	string	Routed URL.
	*/
	public static function urlRequest($vars = array())
	{
		$parts = array();

		// Authorisated followers
		$authorizedInUrl = array(
					'option' => null, 
					'view' => null, 
					'layout' => null, 
					'Itemid' => null, 
					'tmpl' => null, 
					'lang' => null);

		$jinput = new JInput;

		$request = $jinput->getArray($authorizedInUrl);

		foreach($request as $key => $value)
			if (!empty($value))
				$parts[] = $key . '=' . $value;

		$cid = $jinput->get('cid', array(), 'ARRAY');
		if (!empty($cid))
		{
			$cidVals = implode(",", $cid);
			if ($cidVals != '0')
				$parts[] = 'cid[]=' . $cidVals;
		}

		if (count($vars))
		foreach($vars as $key => $value)
			$parts[] = $key . '=' . $value;

		return JRoute::_("index.php?" . implode("&", $parts), false);
	}


}



