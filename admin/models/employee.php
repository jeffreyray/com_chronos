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

require_once(JPATH_ADMIN_CHRONOS .DS.'classes'.DS.'jmodel.item.php');


/**
* Chronos Item Model
*
* @package	Chronos
* @subpackage	Classes
*/
class ChronosModelEmployee extends ChronosModelItem
{
	/**
	* List of all fields files indexes
	*
	* @var array
	*/
	protected $fileFields = array('image');

	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_item = 'employee';

	/**
	* View list alias
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
		parent::__construct();
	}

	/**
	* Method to delete a employee
	*
	* @access	public
	* @param	array	&$pks	The Ids of elements to delete.
	*
	* @return	boolean	True on success
	*/
	public function delete(&$pks = array())
	{
		if (!count( $pks ))
			return true;

		//Integrity : delete the files associated to this deleted item
		if (!$this->deleteFiles($pks, array(
										'image' => 'delete'
											))){
			JError::raiseWarning( 1303, JText::_("DEMO120_ALERT_ERROR_ON_DELETE_FILES") );
			return false;
		}

		if (!parent::delete($pks))
			return false;



		return true;
	}

	/**
	* Method to get the layout (including default).
	*
	* @access	public
	*
	* @return	string	The layout alias.
	*/
	public function getLayout()
	{
		$jinput = new JInput;
		return $jinput->get('layout', 'employee', 'STRING');
	}

	/**
	* Returns a Table object, always creating it.
	*
	* @access	public
	* @param	string	$type	The table type to instantiate.
	* @param	string	$prefix	A prefix for the table class name. Optional.
	* @param	array	$config	Configuration array for model. Optional.
	*
	* @return	JTable	A database object
	*
	* @since	1.6
	*/
	public function getTable($type = 'employee', $prefix = 'ChronosTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	* Method to increment hits (check session and layout)
	*
	* @access	public
	*
	* @return	boolean	Null if skipped. True when incremented. False if error.
	*
	* @since	11.1
	*/
	public function hit()
	{
		return parent::hit(array());
	}

	/**
	* Method to get the data that should be injected in the form.
	*
	* @access	protected
	*
	* @return	mixed	The data for the form.
	*/
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_chronos.edit.employee.data', array());

		if (empty($data)) {
			//Default values shown in the form for new item creation
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('employee.id') == 0)
			{
				$jinput = new JInput;

				$data->id = 0;
				$data->params = null;
				$data->number = null;
				$data->tags = null;
				$data->first_name = null;
				$data->middle_name = null;
				$data->last_name = null;
				$data->facility = $jinput->get('filter_facility', $this->getState('filter.facility'), 'INT');
				$data->position = $jinput->get('filter_position', $this->getState('filter.position'), 'INT');
				$data->birth_date = null;
				$data->image = null;
				$data->active = 1;
				$data->gender = $jinput->get('filter_gender', $this->getState('filter.gender'), 'STRING');
				$data->hire_date = null;
				$data->alt_hire_date = null;
				$data->passed_probation = null;
				$data->termination_date = null;
				$data->termination_reason = $jinput->get('filter_termination_reason', $this->getState('filter.termination_reason'), 'INT');
				$data->referral_source = $jinput->get('filter_referral_source', $this->getState('filter.referral_source'), 'INT');
				$data->referrer = $jinput->get('filter_referrer', $this->getState('filter.referrer'), 'INT');
				$data->tier = $jinput->get('filter_tier', $this->getState('filter.tier','1'), 'STRING');
				$data->note = null;
				$data->contact_info = null;
				$data->access = 1;
				$data->created_by = null;
				$data->creation_date = null;
				$data->modified_by = null;
				$data->modification_date = null;
				$data->checked_out = 0;
				$data->checked_out_time = null;


			}
		}
		return $data;
	}

	/**
	* Method to auto-populate the model state.
	* 
	* This method should only be called once per instantiation and is designed to
	* be called on the first call to the getState() method unless the model
	* configuration flag to ignore the request is set.
	* 
	* Note. Calling getState in this method will result in recursion.
	*
	* @access	public
	* @param	string	$ordering	
	* @param	string	$direction	
	* @return	void
	*
	* @since	11.1
	*/
	public function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();
		$session = JFactory::getSession();



		parent::populateState($ordering, $direction);
	}

	/**
	* Preparation of the query.
	*
	* @access	protected
	* @param	object	&$query	returns a filled query object.
	* @param	integer	$pk	The primary id key of the employee
	* @return	void
	*/
	protected function prepareQuery(&$query, $pk)
	{

		//FROM : Main table
		$query->from('chr_employees AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.access,'
						.	'a.checked_out,'
						.	'a.created_by');

		switch($this->getState('context'))
		{
			case 'employee.employee':

				//BASE FIELDS
				$this->addSelect(	'a.checked_out_time');


				//SELECT
				$this->addSelect('_checked_out_.name AS `_checked_out_name`');

				//JOIN
				$this->addJoin('`#__users` AS _checked_out_ ON _checked_out_.id = a.checked_out', 'LEFT');

				break;
			default:
				//SELECT : raw complete query without joins
				$query->select('a.*');
				break;
		}

		//SELECT : Instance Add-ons
		foreach($this->getState('query.select', array()) as $select)
			$query->select($select);

		//JOIN : Instance Add-ons
		foreach($this->getState('query.join.left', array()) as $join)
			$query->join('LEFT', $join);

		//WHERE : Item layout (based on $pk)
		$query->where('a.id = ' . (int) $pk);		//TABLE KEY


		//WHERE : Access
		//WHERE : Publish, publish date (state field)
	}

	/**
	* Prepare and sanitise the table prior to saving.
	*
	* @access	protected
	* @param	JTable	&$table	A JTable object.
	*
	* @return	void	
	* @return	void
	*
	* @since	1.6
	*/
	protected function prepareTable(&$table)
	{
		$date = JFactory::getDate();
		if ($table->active === null)
			$table->active = 1;

		if ($table->gender == null)
			$table->gender = 'f';

		if ($table->tier == null)
			$table->tier = '1';

		if ($table->access == null)
			$table->access = 1;

		if ($table->checked_out == null)
			$table->checked_out = 0;
		if (empty($table->id)){
			//Defines automatically the author of this element
			$table->created_by = JFactory::getUser()->get('id');
		}
		else{
			//Defines automatically the editor of this element
			$table->modified_by = JFactory::getUser()->get('id');

			//Modification date
			$table->modification_date = $date->toSql();
		}
		//Creation date
		if (empty($table->creation_date))
			$table->creation_date = $date->toSql();
	}


}



