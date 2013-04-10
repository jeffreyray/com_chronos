<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Scheduledshifts
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
class ChronosModelScheduledshifts extends ChronosModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'scheduledshift';

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
				'_employee_number', '_employee_.number',
				'_employee_first_name', '_employee_.first_name',
				'_employee_last_name', '_employee_.last_name',
				'_shift_type_label', '_shift_type_.label',
				'start', 'a.start',
				'comment', 'a.comment',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'employee' => 'int',
			'shift_type' => 'int',
			'start_from' => 'cmd',
			'start_to' => 'cmd',
			'start' => 'date:%Y-%m-%d %H:%M'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search' => 'varchar'
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
		$query->from('chr_scheduledshifts AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.access,'
						.	'a.created_by');

		switch($this->getState('context'))
		{
			case 'scheduledshifts.default':

				//BASE FIELDS
				$this->addSelect(	'a.comment,'
								.	'a.employee,'
								.	'a.end,'
								.	'a.shift_type,'
								.	'a.start');

				//SELECT
				$this->addSelect('_employee_.number AS `_employee_number`');
				$this->addSelect('_employee_.last_name AS `_employee_last_name`');
				$this->addSelect('_employee_.first_name AS `_employee_first_name`');
				$this->addSelect('_shift_type_.label AS `_shift_type_label`');

				//JOIN
				$this->addJoin('`chr_employees` AS _employee_ ON _employee_.id = a.employee', 'LEFT');
				$this->addJoin('`chr_shifttypes` AS _shift_type_ ON _shift_type_.id = a.shift_type', 'LEFT');

				break;
			default:
				//SELECT : raw complete query without joins
				$this->addSelect('a.*');

				// Disable the pagination
				$this->setState('list.limit', null);
				$this->setState('list.start', null);
				break;
		}

		//WHERE - SEARCH : search_search : search on Comment
		$search_search = $this->getState('search.search');
		$this->addSearch('search', 'a.comment', 'like');
		if (($search_search != '') && ($search_search_val = $this->buildSearch('search', $search_search)))
			$this->addWhere($search_search_val);

		//WHERE - FILTER : Employee
		if($this->getState('filter.employee') != null)
			$this->addWhere('a.employee = '. (int)$this->getState('filter.employee'));

		//WHERE - FILTER : Shift Type
		if($this->getState('filter.shift_type') != null)
			$this->addWhere('a.shift_type = '. (int)$this->getState('filter.shift_type'));

		//WHERE - FILTER : Start (RANGE)
		if($this->getState('filter.start_from'))
			$query->where('DATEDIFF(a.start, ' . JFactory::getDBO()->Quote($this->getState('filter.start_from')) . ') >= 0');

		if($this->getState('filter.start_to'))
			$query->where('DATEDIFF(a.start, '. JFactory::getDBO()->Quote($this->getState('filter.start_to')) . ') <= 0');

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



