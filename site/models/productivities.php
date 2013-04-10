<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Productivities
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
class ChronosModelProductivities extends ChronosModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'productivity';

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
				'_employee_facility_label', '_employee_facility_.label',
				'_employee_number', '_employee_.number',
				'_employee_first_name', '_employee_.first_name',
				'_employee_last_name', '_employee_.last_name',
				'_study_number', '_study_.number',
				'date', 'a.date',
				'completes', 'a.completes',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'employee' => 'int',
			'study' => 'int',
			'source' => 'string',
			'employee_facility' => 'int',
			'study_client' => 'int'
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

		parent::populateState('a.completes', 'asc');
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
		$query->from('chr_productivities AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.created_by');

		switch($this->getState('context'))
		{
			case 'productivities.default':

				//BASE FIELDS
				$this->addSelect(	'a.completes,'
								.	'a.date,'
								.	'a.employee,'
								.	'a.source,'
								.	'a.study');

				//SELECT
				$this->addSelect('_employee_.number AS `_employee_number`');
				$this->addSelect('_employee_.last_name AS `_employee_last_name`');
				$this->addSelect('_employee_.facility AS `_employee_facility`');
				$this->addSelect('_employee_facility_.label AS `_employee_facility_label`');
				$this->addSelect('_study_.number AS `_study_number`');
				$this->addSelect('_study_.client AS `_study_client`');
				$this->addSelect('_study_client_.name AS `_study_client_name`');
				$this->addSelect('_employee_.first_name AS `_employee_first_name`');

				//JOIN
				$this->addJoin('`chr_employees` AS _employee_ ON _employee_.id = a.employee', 'LEFT');
				$this->addJoin('`chr_facilities` AS _employee_facility_ ON _employee_facility_.id = _employee_.facility', 'LEFT');
				$this->addJoin('`chr_studies` AS _study_ ON _study_.id = a.study', 'LEFT');
				$this->addJoin('`chr_clients` AS _study_client_ ON _study_client_.id = _study_.client', 'LEFT');

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

		//WHERE - FILTER : Label
		if($this->getState('filter._employee_facility'))
			$this->addWhere('_employee_.facility = '. $this->_db->Quote($this->getState('filter._employee_facility')));

		//WHERE - FILTER : Study
		if($this->getState('filter.study') != null)
			$this->addWhere('a.study = '. (int)$this->getState('filter.study'));

		//WHERE - FILTER : Name
		if($this->getState('filter._study_client'))
			$this->addWhere('_study_.client = '. $this->_db->Quote($this->getState('filter._study_client')));

		//WHERE - FILTER : Source
		if($this->getState('filter.source'))
			$this->addWhere('a.source = '. $this->_db->Quote($this->getState('filter.source')));

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



