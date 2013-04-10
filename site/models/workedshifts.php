<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Workedshifts
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

require_once(JPATH_ADMIN_CHRONOS .DS.'classes'.DS.'jmodel.list.php');


/**
* Chronos List Model
*
* @package	Chronos
* @subpackage	Classes
*/
class ChronosModelWorkedshifts extends ChronosModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'workedshift';

	/**
	* Constructor
	*
	* @access	public
	* @param	array	$config	An optional associative array of configuration settings.
	* @return	void
	*/
	public function __construct($config = array())
	{
		//Define the sortables fields (in lists)
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'_facility_label', '_facility_.label',
				'_employee_number', '_employee_.number',
				'_employee_first_name', '_employee_.first_name',
				'_employee_last_name', '_employee_.last_name',
				'_employee_position', '_employee_position_.position',
				'time_in', 'a.time_in',
				'time_out', 'a.time_out',
				'break_length', 'a.break_length',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'time_in_from' => 'cmd',
			'time_in_to' => 'cmd',
			'time_in' => 'date:%Y-%m-%d %H:%M',
			'employee' => 'int',
			'facility' => 'int',
			'scheduled_shift' => 'int'
				));


		parent::__construct($config);
		
	}

	/**
	* Method to get a list of items.
	*
	* @access	public
	*
	* @return	mixed	An array of data items on success, false on failure.
	*
	* @since	11.1
	*/
	public function getItems()
	{

		$items	= parent::getItems();
		$app	= JFactory::getApplication();


		$this->populateParams($items);

		//Create linked objects
		$this->populateObjects($items);

		return $items;
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
		return $jinput->get('layout', 'default', 'STRING');
	}

	/**
	* Method to get a store id based on model configuration state.
	* 
	* This is necessary because the model is used by the component and different
	* modules that might need different sets of data or differen ordering
	* requirements.
	*
	* @access	protected
	* @param	string	$id	A prefix for the store id.
	* @return	void
	*
	* @since	1.6
	*/
	protected function getStoreId($id = '')
	{
		// Compile the store id.


		return parent::getStoreId($id);
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
		// Initialise variables.
		$app = JFactory::getApplication();
		$session = JFactory::getSession();
		$acl = ChronosHelper::getActions();

		parent::populateState('a.employee', 'asc');
	}

	/**
	* Preparation of the list query.
	*
	* @access	protected
	* @param	object	&$query	returns a filled query object.
	* @return	void
	*/
	protected function prepareQuery(&$query)
	{
		$user = JFactory::getUser();
		$acl = ChronosHelper::getActions();

		//FROM : Main table
		$query->from('chr_workedshifts AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.access,'
						.	'a.created_by');

		switch($this->getState('context'))
		{
			case 'workedshifts.default':

				//BASE FIELDS
				$this->addSelect(	'a.break_length,'
								.	'a.employee,'
								.	'a.facility,'
								.	'a.time_in,'
								.	'a.time_out');

				//SELECT
				$this->addSelect('_facility_.label AS `_facility_label`');
				$this->addSelect('_employee_.number AS `_employee_number`');
				$this->addSelect('_employee_.position AS `_employee_position`');
				$this->addSelect('_employee_.first_name AS `_employee_first_name`');
				$this->addSelect('_employee_.last_name AS `_employee_last_name`');

				//JOIN
				$this->addJoin('`chr_facilities` AS _facility_ ON _facility_.id = a.facility', 'LEFT');
				$this->addJoin('`chr_employees` AS _employee_ ON _employee_.id = a.employee', 'LEFT');

				break;
			default:
				//SELECT : raw complete query without joins
				$this->addSelect('a.*');

				// Disable the pagination
				$this->setState('list.limit', null);
				$this->setState('list.start', null);
				break;
		}

		//WHERE - FILTER : Employee
		if($this->getState('filter.employee') != null)
			$this->addWhere('a.employee = '. (int)$this->getState('filter.employee'));

		//WHERE - FILTER : Facility
		if($this->getState('filter.facility') != null)
			$this->addWhere('a.facility = '. (int)$this->getState('filter.facility'));

		//WHERE - FILTER : Scheduled Shift
		if($this->getState('filter.scheduled_shift') != null)
			$this->addWhere('a.scheduled_shift = '. (int)$this->getState('filter.scheduled_shift'));

		//WHERE - FILTER : Time in (RANGE)
		if($this->getState('filter.time_in_from'))
			$query->where('DATEDIFF(a.time_in, ' . JFactory::getDBO()->Quote($this->getState('filter.time_in_from')) . ') >= 0');

		if($this->getState('filter.time_in_to'))
			$query->where('DATEDIFF(a.time_in, '. JFactory::getDBO()->Quote($this->getState('filter.time_in_to')) . ') <= 0');

		// WHERE : Implement View Level Access
		if (!$acl->get('core.admin'))
		{
		    $groups	= implode(',', $user->getAuthorisedViewLevels());
			$query->where('a.access IN ('.$groups.')');
		}

		//Populate only uniques strings to the query
		//SELECT
		foreach($this->getState('query.select', array()) as $select)
			$query->select($select);

		//JOIN
		foreach($this->getState('query.join.left', array()) as $join)
			$query->join('LEFT', $join);

		//WHERE
		foreach($this->getState('query.where', array()) as $where)
			$query->where($where);

		//ORDER
		foreach($this->getState('query.groupby', array()) as $groupby)
			$query->order($groupby);

		//ORDER
		foreach($this->getState('query.order', array()) as $order)
			$query->order($order);

		//ORDER
		$orderCol = $this->getState('list.ordering');
		$orderDir = $this->getState('list.direction', 'asc');

		if ($orderCol)
			$query->order($orderCol . ' ' . $orderDir);
	}


}



