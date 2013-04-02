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

require_once(JPATH_ADMIN_CHRONOS .DS. "classes" .DS. "jcontroller.item.php");


/**
* Chronos Employee Controller
*
* @package	Chronos
* @subpackage	Employee
*/
class ChronosControllerEmployee extends ChronosControllerItem
{
	/**
	* The context for storing internal data, e.g. record.
	*
	* @var string
	*/
	protected $context = 'employee';

	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'employee';

	/**
	* The URL view list variable.
	*
	* @var string
	*/
	protected $view_list = 'employees';

	/**
	* Constructor
	*
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	* @return	void
	*/
	public function __construct($config = array())
	{
		parent::__construct($config);
		$app = JFactory::getApplication();
		$this->registerTask('toggle_active', 'toggle');


	}

	/**
	* Override method when the author allowed to delete own.
	*
	* @access	protected
	* @param	array	$data	An array of input data.
	* @param	string	$key	The name of the key for the primary key; default is id..
	*
	* @return	boolean	True on success
	*/
	protected function allowDelete($data = array(), $key = id)
	{
		return parent::allowDelete($data, $key, array(
			'key_author' => 'created_by'
			));
	}

	/**
	* Override method when the author allowed to edit own.
	*
	* @access	protected
	* @param	array	$data	An array of input data.
	* @param	string	$key	The name of the key for the primary key; default is id..
	*
	* @return	boolean	True on success
	*/
	protected function allowEdit($data = array(), $key = id)
	{
		return parent::allowEdit($data, $key, array(
			'key_author' => 'created_by'
			));
	}

	/**
	* Return the current layout.
	*
	* @access	protected
	* @param	bool	$default	If true, return the default layout.
	*
	* @return	string	Requested layout or default layout
	*/
	protected function getLayout($default = null)
	{
		if ($default === 'edit')
			return 'employee';

		if ($default)
			return 'employee';

		$jinput = new JInput;
		return $jinput->get('layout', 'employee', 'CMD');
	}

	/**
	* Function that allows child controller access to model data after the data
	* has been saved.
	*
	* @access	protected
	* @param	JModel	&$model	The data model object.
	* @param	array	$validData	The validated data.
	* @return	void
	*/
	protected function postSaveHook(&$model, $validData = array())
	{
		parent::postSaveHook($model, $validData);
		//UPLOAD FILE : Image
		$model->_upload('image', array(
										'image/bmp' => 'bmp',
										'image/gif' => 'gif',
										'image/jpeg' => 'jpg,jpeg',
										'image/png' => 'png')
															, array(
										'rename' => '{BASE}-{RAND#8}.{MIMEXT}',

															));
	}


}



