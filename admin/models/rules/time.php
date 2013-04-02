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
defined('_JEXEC') or die('Restricted access');

if (!class_exists('CHRONOSJFormRule'))
	require_once(JPATH_ADMIN_CHRONOS .DS. 'classes' .DS. 'rule.php');
cimport('helpers.dates');


/**
* Form validator rule for Chronos.
*
* @package	Chronos
* @subpackage	Form
*/
class JFormRuleTime extends ChronosJFormRule
{
	/**
	* Specifiate the default format.
	*
	* @var string
	*/
	protected $dateFormat = '%Y-%m-%d';

	/**
	* Indicates that this class contains special methods (ie: get()).
	*
	* @var boolean
	*/
	public $extended = true;

	/**
	* Unique name for this rule.
	*
	* @var string
	*/
	protected $handler = 'time';

	/**
	* Proxy to access protected methods.
	*
	* @access	public
	* @param	string	$var	The name of the property.
	*
	* @return	mixed	The value of the property. Null if not in the list.
	*/
	public function __get($var)
	{
		if ($var == 'regex')
			return ChronosHelperDates::strftime2regex($this->dateFormat, false, false);

		if (in_array($var, array('regex', 'regexJs', 'modifiers', 'handler')))
			if (isset($this->$var))
				return $this->$var;
	}

	/**
	* Method to test the field.
	*
	* @access	public
	* @param	JXMLElement	&$element	The JXMLElement object representing the <field /> tag for the form field object.
	* @param	mixed	$value	The form field value to validate.
	* @param	string	$group	The field name group control value. This acts as as an array container for the field.
	* @param	JRegistry	&$input	An optional JRegistry object with the entire data set to validate against the entire form.
	* @param	object	&$form	The form object for which the field is being tested.
	*
	* @return	boolean	True if the value is valid, false otherwise.
	*
	* @since	11.1
	*/
	public function test(&$element, $value, $group = null, &$input = null, &$form = null)
	{
		// Common test : Required, Unique
		if (!self::testDefaults($element, $value, $group, $input, $form))
			return false;
		//Convert the date format (strftime) in regular exprassion
		$this->regex = ChronosHelperDates::strftime2regex($this->dateFormat, false);

		return true;
	}


}



