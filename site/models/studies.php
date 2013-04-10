<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Studies
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
class ChronosModelStudies extends ChronosModelList
{
	/**
	* The URL view item variable.
	*
	* @var string
	*/
	protected $view_item = 'study';

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
				'title', 'a.title',
				'_facility_label', '_facility_.label',
				'_client_name', '_client_.name',
				'start_date', 'a.start_date',
				'active', 'a.active',

			);
		}

		//Define the filterable fields
		$this->set('filter_vars', array(
			'active' => 'string',
			'facility' => 'int',
			'start_date_from' => 'date:%Y-%m-%d',
			'start_date_to' => 'date:%Y-%m-%d',
			'umbrella' => 'int',
			'client' => 'int',
			'briefing' => 'int',
			'primary_manager' => 'int',
			'secondary_manager' => 'int',
			'start_date' => 'date:%Y-%m-%d'
				));

		//Define the searchable fields
		$this->set('search_vars', array(
			'search_title' => 'varchar',
			'search_tags' => 'varchar'
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
		$user = JFactory::getUser();

		parent::populateState('a.number', 'asc');

		//Only show the published items
		if (!$acl->get('core.admin') && !$acl->get('core.edit.state'))
			$this->setState('filter.published', 1);
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
		$query->from('chr_studies AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.access,'
						.	'a.created_by,'
						.	'a.published');

		switch($this->getState('context'))
		{
			case 'studies.default':

				//BASE FIELDS
				$this->addSelect(	'a.active,'
								.	'a.client,'
								.	'a.facility,'
								.	'a.number,'
								.	'a.start_date,'
								.	'a.title');

				//SELECT
				$this->addSelect('_facility_.label AS `_facility_label`');
				$this->addSelect('_client_.name AS `_client_name`');

				//JOIN
				$this->addJoin('`chr_facilities` AS _facility_ ON _facility_.id = a.facility', 'LEFT');
				$this->addJoin('`chr_clients` AS _client_ ON _client_.id = a.client', 'LEFT');

				break;
			default:
				//SELECT : raw complete query without joins
				$this->addSelect('a.*');

				// Disable the pagination
				$this->setState('list.limit', null);
				$this->setState('list.start', null);
				break;
		}

		//WHERE - SEARCH : search_search_title : search on Title
		$search_search_title = $this->getState('search.search_title');
		$this->addSearch('search_title', 'a.title', 'like');
		if (($search_search_title != '') && ($search_search_title_val = $this->buildSearch('search_title', $search_search_title)))
			$this->addWhere($search_search_title_val);

		//WHERE - SEARCH : search_search_tags : search on Tags
		$search_search_tags = $this->getState('search.search_tags');
		$this->addSearch('search_tags', 'a.tags', 'like');
		if (($search_search_tags != '') && ($search_search_tags_val = $this->buildSearch('search_tags', $search_search_tags)))
			$this->addWhere($search_search_tags_val);

		//WHERE - FILTER : Active
		if($this->getState('filter.active') != null)
			$this->addWhere('a.active = '. (int)$this->getState('filter.active'));

		//WHERE - FILTER : Facility
		if($this->getState('filter.facility') != null)
			$this->addWhere('a.facility = '. (int)$this->getState('filter.facility'));

		//WHERE - FILTER : Umbrella
		if($this->getState('filter.umbrella') != null)
			$this->addWhere('a.umbrella = '. (int)$this->getState('filter.umbrella'));

		//WHERE - FILTER : Client
		if($this->getState('filter.client') != null)
			$this->addWhere('a.client = '. (int)$this->getState('filter.client'));

		//WHERE - FILTER : Briefing
		if($this->getState('filter.briefing') != null)
			$this->addWhere('a.briefing = '. (int)$this->getState('filter.briefing'));

		//WHERE - FILTER : Primary Manager
		if($this->getState('filter.primary_manager') != null)
			$this->addWhere('a.primary_manager = '. (int)$this->getState('filter.primary_manager'));

		//WHERE - FILTER : Secondary Manager
		if($this->getState('filter.secondary_manager') != null)
			$this->addWhere('a.secondary_manager = '. (int)$this->getState('filter.secondary_manager'));

		//WHERE - FILTER : Start Date (RANGE)
		if($this->getState('filter.start_date_from'))
			$query->where('DATEDIFF(a.start_date, ' . JFactory::getDBO()->Quote($this->getState('filter.start_date_from')) . ') >= 0');

		if($this->getState('filter.start_date_to'))
			$query->where('DATEDIFF(a.start_date, '. JFactory::getDBO()->Quote($this->getState('filter.start_date_to')) . ') <= 0');

		// WHERE : Implement View Level Access
		if (!$acl->get('core.admin'))
		{
		    $groups	= implode(',', $user->getAuthorisedViewLevels());
			$query->where('a.access IN ('.$groups.')');
		}

		// Filter by published state
		$publish = $this->getState('filter.published');
		$query->where('('
					.	(($publish !== null)?'a.published = ' . (int)$publish:'a.published = 1')
					.	(($acl->get('core.edit.state') || $acl->get('core.edit.own') || $acl->get('core.view.own'))?' OR a.created_by = ' . (int)JFactory::getUser()->get('id'):'')
					.	(($publish === null)?' OR a.published IS NULL':'')
					.	(($publish == null) && $acl->get('core.edit.state')?' OR a.published = 0':'')
					.	')');

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



