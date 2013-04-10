<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Wages
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
class ChronosModelWages extends ChronosModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'wage';

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
				'date_effective', 'a.date_effective',
				'_reason_label', '_reason_.label',
				'value', 'a.value',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'employee' => 'int',
			'reason' => 'int',
			'date_effective_from' => 'date:%Y-%m-%d',
			'date_effective_to' => 'date:%Y-%m-%d',
			'date_effective' => 'date:%Y-%m-%d'
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
		$query->from('chr_wages AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.access,'
						.	'a.created_by');

		switch($this->getState('context'))
		{
			case 'wages.default':

				//BASE FIELDS
				$this->addSelect(	'a.comment,'
								.	'a.date_effective,'
								.	'a.employee,'
								.	'a.reason,'
								.	'a.value');

				//SELECT
				$this->addSelect('_employee_.number AS `_employee_number`');
				$this->addSelect('_employee_.last_name AS `_employee_last_name`');
				$this->addSelect('_employee_.first_name AS `_employee_first_name`');
				$this->addSelect('_reason_.label AS `_reason_label`');

				//JOIN
				$this->addJoin('`chr_employees` AS _employee_ ON _employee_.id = a.employee', 'LEFT');
				$this->addJoin('`chr_wagereasons` AS _reason_ ON _reason_.id = a.reason', 'LEFT');

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

		//WHERE - FILTER : Reason
		if($this->getState('filter.reason') != null)
			$this->addWhere('a.reason = '. (int)$this->getState('filter.reason'));

		//WHERE - FILTER : Date Effective (RANGE)
		if($this->getState('filter.date_effective_from'))
			$query->where('DATEDIFF(a.date_effective, ' . JFactory::getDBO()->Quote($this->getState('filter.date_effective_from')) . ') >= 0');

		if($this->getState('filter.date_effective_to'))
			$query->where('DATEDIFF(a.date_effective, '. JFactory::getDBO()->Quote($this->getState('filter.date_effective_to')) . ') <= 0');

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



