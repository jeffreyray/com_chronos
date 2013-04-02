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

require_once(JPATH_ADMIN_CHRONOS .DS.'classes'.DS.'jmodel.item.php');


/**
* Chronos Item Model
*
* @package	Chronos
* @subpackage	Classes
*/
class ChronosModelStudy extends ChronosModelItem
{
	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_item = 'study';

	/**
	* View list alias
	*
	* @var string
	*/
	protected $view_list = 'studies';

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
	* Method to delete a study
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
		return $jinput->get('layout', 'study', 'STRING');
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
	public function getTable($type = 'study', $prefix = 'ChronosTable', $config = array())
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
		$data = JFactory::getApplication()->getUserState('com_chronos.edit.study.data', array());

		if (empty($data)) {
			//Default values shown in the form for new item creation
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('study.id') == 0)
			{
				$jinput = new JInput;

				$data->id = 0;
				$data->params = null;
				$data->number = null;
				$data->title = null;
				$data->alias = null;
				$data->facility = $jinput->get('filter_facility', $this->getState('filter.facility'), 'INT');
				$data->client = $jinput->get('filter_client', $this->getState('filter.client'), 'INT');
				$data->tags = null;
				$data->start_date = null;
				$data->deadline = null;
				$data->finish_date = null;
				$data->briefing = $jinput->get('filter_briefing', $this->getState('filter.briefing'), 'INT');
				$data->active = 1;
				$data->display = 1;
				$data->published = 1;
				$data->cati_code = null;
				$data->cost_code = null;
				$data->creation_date = null;
				$data->modification_date = null;
				$data->created_by = null;
				$data->modified_by = null;
				$data->access = null;
				$data->note = null;
				$data->primary_manager = $jinput->get('filter_primary_manager', $this->getState('filter.primary_manager'), 'INT');
				$data->secondary_manager = $jinput->get('filter_secondary_manager', $this->getState('filter.secondary_manager'), 'INT');
				$data->quota = null;
				$data->target_cph = null;
				$data->target_length = null;
				$data->target_incidence = null;
				$data->tier = $jinput->get('filter_tier', $this->getState('filter.tier'), 'STRING');
				$data->final_cph = null;
				$data->final_length = null;
				$data->completes = null;
				$data->final_incidence = null;


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

		if ($search_search = $app->getUserState($this->context.'.search.search'))
			$this->setState('search.search', $search_search, null, 'varchar');

		if ($filter_facility = $app->getUserState($this->context.'.filter.facility'))
			$this->setState('filter.facility', $filter_facility, null, 'int');

		if ($filter_client = $app->getUserState($this->context.'.filter.client'))
			$this->setState('filter.client', $filter_client, null, 'int');



		parent::populateState($ordering, $direction);
	}

	/**
	* Preparation of the query.
	*
	* @access	protected
	* @param	object	&$query	returns a filled query object.
	* @param	integer	$pk	The primary id key of the study
	* @return	void
	*/
	protected function prepareQuery(&$query, $pk)
	{

		//FROM : Main table
		$query->from('chr_studies AS a');



		//IMPORTANT REQUIRED FIELDS
		$this->addSelect(	'a.id,'
						.	'a.access,'
						.	'a.created_by,'
						.	'a.published');

		switch($this->getState('context'))
		{
			case 'study.study':

				//BASE FIELDS
				$this->addSelect(	'a.alias,'
								.	'a.client,'
								.	'a.creation_date,'
								.	'a.facility,'
								.	'a.finish_date,'
								.	'a.modification_date,'
								.	'a.modified_by,'
								.	'a.number,'
								.	'a.start_date,'
								.	'a.title');

				//SELECT
				$this->addSelect('_client_.name AS `_client_name`');
				$this->addSelect('_facility_.label AS `_facility_label`');
				$this->addSelect('_access_.title AS `_access_title`');

				//JOIN
				$this->addJoin('`chr_clients` AS _client_ ON _client_.id = a.client', 'LEFT');
				$this->addJoin('`chr_facilities` AS _facility_ ON _facility_.id = a.facility', 'LEFT');
				$this->addJoin('`#__viewlevels` AS _access_ ON _access_.id = a.access', 'LEFT');

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

		if ($table->display === null)
			$table->display = 1;

		if ($table->published === null)
			$table->published = 1;

		if ($table->access == null)
			$table->access = 1;

		if ($table->tier == null)
			$table->tier = '1';
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
		//Alias
		if (empty($table->alias))
			$table->alias = JApplication::stringURLSafe($table->title);

		//Creation date
		if (empty($table->creation_date))
			$table->creation_date = $date->toSql();
	}


}



