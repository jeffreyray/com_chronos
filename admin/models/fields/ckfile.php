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

@define("JPATH_ADMIN_CHRONOS", JPATH_ADMINISTRATOR .DS. 'components' .DS. 'com_chronos');
if (!class_exists('ChronosJFormField'))
	require_once(JPATH_ADMIN_CHRONOS .DS. 'classes' .DS. 'formfield.php');


/**
* Form field for Chronos.
*
* @package	Chronos
* @subpackage	Form
*/
class JFormFieldCkfile extends ChronosJFormField
{
	/**
	* The form field type.
	*
	* @var string
	*/
	public $type = 'ckfile';

	/**
	* Method to get the field input markup.
	*
	* @access	public
	*
	* @return	string	The field input markup.
	*
	* @since	11.1
	*/
	public function getInput()
	{

		$this->input = JDom::_('html.form.input.file', array_merge(array(
				'dataKey' => $this->getOption('name'),
				'domClass' => $this->getOption('class'),
				'formControl' => $this->formControl,
				'dataValue' => $this->value,
				'width' => $this->getOption('width'),
				'height' => $this->getOption('height'),
				'view' => $this->getOption('view'),
				'indirect' => $this->getOption('indirect', null, 'bool'),
				'root' => $this->getOption('root'),
				'ruleInstance' => $this->getOption('ruleInstance')
			), $this->jdomOptions));

		return parent::getInput();
	}


}



