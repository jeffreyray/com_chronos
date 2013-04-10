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

require_once(JPATH_ADMIN_CHRONOS .DS.'classes'.DS.'jmodel.list.php');


/**
* Chronos List Model
*
* @package	Chronos
* @subpackage	Classes
*/
class ChronosModelEmployees extends ChronosModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'employee';

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
				'number', 'a.number',
				'first_name', 'a.first_name',
				'last_name', 'a.last_name',
				'_facility_label', '_facility_.label',
				'_position_label', '_position_.label',
				'hire_date', 'a.hire_date',
				'active', 'a.active',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'facility' => 'int',
			'position' => 'int',
			'active' => 'string',
			'termination_reason' => 'int',
			'referral_source' => 'int',
			'referrer' => 'int'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search_name' => 'varchar'
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

		parent::populateState('a.number', 'asc');
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
		$query->from('chr_employees AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.access,'
						.	'a.checked_out,'
						.	'a.created_by,'
						.       "CONCAT_WS(' ', a.number, a.first_name, a.last_name) as name_and_number");

		switch($this->getState('context'))
		{
			case 'employees.default':

				//BASE FIELDS
				$this->addSelect(	'a.active,'
								.	'a.checked_out_time,'
								.	'a.facility,'
								.	'a.first_name,'
								.	'a.hire_date,'
								.	'a.last_name,'
								.	'a.number,'
								.	'a.position');

				//SELECT
				$this->addSelect('_facility_.label AS `_facility_label`');
				$this->addSelect('_position_.label AS `_position_label`');
				$this->addSelect('_checked_out_.name AS `_checked_out_name`');

				//JOIN
				$this->addJoin('`chr_facilities` AS _facility_ ON _facility_.id = a.facility', 'LEFT');
				$this->addJoin('`chr_positions` AS _position_ ON _position_.id = a.position', 'LEFT');
				$this->addJoin('`#__users` AS _checked_out_ ON _checked_out_.id = a.checked_out', 'LEFT');

				break;
			default:
				//SELECT : raw complete query without joins
				$this->addSelect('a.*');

				// Disable the pagination
				$this->setState('list.limit', null);
				$this->setState('list.start', null);
				break;
		}

		//WHERE - SEARCH : search_search_name : search on First Name
		$search_search_name = $this->getState('search.search_name');
		$this->addSearch('search_name', 'a.first_name', 'like');
		if (($search_search_name != '') && ($search_search_name_val = $this->buildSearch('search_name', $search_search_name)))
			$this->addWhere($search_search_name_val);

		//WHERE - FILTER : Facility
		if($this->getState('filter.facility') != null)
			$this->addWhere('a.facility = '. (int)$this->getState('filter.facility'));

		//WHERE - FILTER : Position
		if($this->getState('filter.position') != null)
			$this->addWhere('a.position = '. (int)$this->getState('filter.position'));

		//WHERE - FILTER : Active
		if($this->getState('filter.active') != null)
			$this->addWhere('a.active = '. (int)$this->getState('filter.active'));

		//WHERE - FILTER : Termination Reason
		if($this->getState('filter.termination_reason') != null)
			$this->addWhere('a.termination_reason = '. (int)$this->getState('filter.termination_reason'));

		//WHERE - FILTER : Referral Source
		if($this->getState('filter.referral_source') != null)
			$this->addWhere('a.referral_source = '. (int)$this->getState('filter.referral_source'));

		//WHERE - FILTER : Referrer
		if($this->getState('filter.referrer') != null)
			$this->addWhere('a.referrer = '. (int)$this->getState('filter.referrer'));

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



