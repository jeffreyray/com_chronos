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


/**
* Form validator rule for Chronos.
*
* @package	Chronos
* @subpackage	Form
*/
class JFormRuleMultiple extends ChronosJFormRule
{
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
	protected $handler = 'multiple';

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
		// If the rules are empty, the field is valid.
		if (empty($element['rules']))
			return true;

		//Combine and test all rules.
		$rulesParam = $element['rules'];
		$rulesParam = str_replace(",", " ", $rulesParam);
		$rules = explode(" ", $rulesParam);
		foreach($rules as $type)
		{
			// Load the JFormRule object for the field.
			$rule = JFormHelper::loadRuleType($type);

			// If the object could not be loaded return an error message.
			if ($rule === false)
				return new JException(JText::sprintf('JLIB_FORM_VALIDATE_FIELD_RULE_MISSING', $type), -2, E_ERROR);

			// Run the field validation rule test.
			if (!$rule->test($element, $value, $group, $input, $form))
				return false;
		}

		return true;
	}


}



