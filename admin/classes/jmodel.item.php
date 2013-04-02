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

jimport('joomla.application.component.modeladmin');


/**
* Chronos Item Model
*
* @package	Chronos
* @subpackage	Classes
*/
class ChronosModelItem extends JModelAdmin
{
	/**
	* Data array
	*
	* @var array
	*/
	protected $_data = null;

	/**
	* Item id
	*
	* @var integer
	*/
	public $_id = null;

	/**
	* Item by id.
	*
	* @var array
	*/
	protected $_item = null;

	/**
	* Item params
	*
	* @var array
	*/
	protected $_params = null;

	/**
	* Context string for the model type.  This is used to handle uniqueness
	*
	* @var string
	*/
	protected $context = null;

	/**
	* List of all fields files indexes
	*
	* @var array
	*/
	protected $fileFields = array();

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

		$layout = $this->getLayout();

		$jinput = new JInput;
		$render = $jinput->get('render', null, 'CMD');

		$this->context = strtolower($this->option . '.' . $this->getName()
					. ($layout?'.' . $layout:'')
					. ($render?'.' . $render:'')
					);
	}

	/**
	* Method to update a file and eventually upload.
	*
	* @access	public
	* @param	string	$fieldName	Field that store the file name.
	* @param	array	$extensions	Allowed extensions.
	* @param	array	$options	Specific options.
	* @param	string	$dir	Root folder (can be a pattern).
	*
	* @return	boolean	False on failure or error, true otherwise.
	*/
	public function _upload($fieldName, $extensions = null, $options = array(), $dir = null)
	{
		//Send the id for eventual name or path parsing in upload
		$options['id'] = $this->getId();

		cimport('classes.upload');
		$config	= JComponentHelper::getParams( 'com_chronos' );

		if (!$dir)
			$dir = $config->get('upload_dir_' . $this->view_list . '_' . $fieldName, '[COM_SITE]' .DS. 'files' .DS. $this->view_list . '_' . $fieldName);

		$jinput = new JInput;

		//Get the submited files if exists
		$fileInput = new JInput($_FILES);
		$files = $fileInput->get('jform', null, 'array');

		$uploadFile = array();
		//Process a conversion to get the right datas
		if (!empty($files))
			foreach($files as $key => $params)
				$uploadFile[$key] = $params[$fieldName];

		$post = $jinput->get('jform', null, 'array');

		// Remove parameter
		$removeVar = "__" . $fieldName . "_remove";
		$remove	= (isset($post[$removeVar])?$post[$removeVar]:null);

		// Previous value parameter
		$previousVar = "__$fieldName";
		$previous = (isset($post[$previousVar])?$post[$previousVar]:null);

		// Upload file name
		$upload = (isset($uploadFile['name'])?$uploadFile['name']:null);

		// New value
		$fileName = null;

		//Check method
		$method = '';
		$changed = false;
		if (!empty($upload))
		{
			$method = 'upload';
			$changed = ($upload != $previous);
		}

		//Check if needed to delete files
		if (in_array($remove, array('remove', 'delete', 'thumbs', 'trash')))
		{
			$fileName = "";		//Clear DB link (remove)
			$changed = true;

			//Process physical removing of the files (All, only thumbs, Move to trash)
			if (in_array($remove, array('delete', 'thumbs', 'trash')))
			{
				$f = (preg_match("/\[.+\]/", $previous)?"":$dir.DS) . $previous;
				if (!ChronosFile::deleteFile($f, $remove)){
					JError::raiseWarning( 4101, JText::_("CHRONOS_TASK_RESULT_IMPOSSIBLE_TO_DELETE") );
				}
			}
		}

		switch($method)
		{
			case 'upload':

				// Process Upload
				$uploadClass = new ChronosUpload($dir);
				$uploadClass->setAllowed($extensions);

				if (!$result = $uploadClass->uploadFile($uploadFile, $options))
				{
					JError::raiseWarning( 4100, JText::sprintf("CHRONOS_TASK_RESULT_IMPOSSIBLE_TO_UPLOAD_FILE", $uploadFile['name']) );
					return false;
				}

				$fileName = $result->filename;
				$changed = true;

				break;
		}

		if ($changed)
		{
			//Store the image file name with path pattern
			if (!$this->save(array($fieldName => $fileName)))
				return false;
		}
		return true;
	}

	/**
	* 
	*
	* @access	public
	* @param	string	$join	
	* @param	string	$type	
	* @return	void
	*/
	public function addJoin($join, $type = 'left')
	{
		$join = preg_replace("/^((LEFT)?(RIGHT)?(INNER)?(OUTER)?\sJOIN)/", "", $join);
		$this->addQuery('join.' . strtolower($type), $join);
	}

	/**
	* Concat SQL parts in query. (Suggested by Cook Self Service)
	*
	* @access	public
	* @param	string	$type	SQL command.
	* @param	string	$queryElement	Command content.
	* @return	void
	*/
	public function addQuery($type, $queryElement)
	{
		$queries = $this->getState('query.' . $type, array());
		if (!in_array($queryElement, $queries))
		{
			$queries[] = $queryElement;
			$this->setState('query.' . $type, $queries);
		}
	}

	/**
	* 
	*
	* @access	public
	* @param	string	$select	
	* @return	void
	*/
	public function addSelect($select)
	{
		$this->addQuery('select', $select);
	}

	/**
	* Check if the user can access this item.
	*
	* @access	public
	* @param	object	$record	A record object.
	*
	* @return	boolean	True if allowed.
	*/
	public function canAccess($record)
	{
		//Check Access
		$keyAccess = 'access';
		if (property_exists($record, $keyAccess)
		&& !empty($record->$keyAccess)
		&& !in_array($record->$keyAccess, JFactory::getUser()->getAuthorisedViewLevels())
		){
			$this->setError(JText::_('JERROR_ALERTNOAUTHOR'));
			return false;
		}

		if (!$this->isVisible($record))
		{
			//Check Author
			$keyAuthor = 'created_by';
			$acl = ChronosHelper::getActions();		
			if (property_exists($record, $keyAuthor)
			&& !empty($record->$keyAccess))
			{
				if ($acl->get('core.edit'))
					return true;
		
				if (($acl->get('core.view.own') || $acl->get('core.edit.own')) 
				&&	$this->isAuthor($record))
					return true;
			}

			return false;
		}

		return true;
	}

	/**
	* Method to check if the item is free of checkout.
	*
	* @access	public
	* @param	object	$record	A record object.
	*
	* @return	boolean	True if allowed. False if checkedout
	*/
	public function canCheck($record)
	{
		$keyCheckOut = 'checked_out';
		//Check if already edited
		if (property_exists($record, $keyCheckOut)
		&& !empty($record->$keyCheckOut)
		&& $record->$keyCheckOut != JFactory::getUser()->get('id'))
		{
			$this->setError(JText::_("CHRONOS_TASK_RESULT_THE_USER_CHECKING_OUT_DOES_NOT_MATCH_THE_USER_WHO_CHECKED_OUT_THE_ITEM"));
			return false;
		}

		return true;
	}

	/**
	* Check if the user can create a new item.
	*
	* @access	public
	*
	* @return	boolean	True if allowed.
	*/
	public function canCreate()
	{
		$acl = ChronosHelper::getActions();
		
		if ($acl->get('core.create'))
			return true;
		
		return false;
	}

	/**
	* Method to test whether a record can be deleted.
	*
	* @access	public
	* @param	object	$record	A record object.
	*
	* @return	boolean	True if allowed to delete the record. Defaults to the permission for the component.
	*/
	public function canDelete($record)
	{
		$acl = ChronosHelper::getActions();

		//Check if can access
		if (!$this->canAccess($record))
			return false;

		//Check if already edited
		if (!$this->canCheck($record))
			return false;

		if ($acl->get('core.delete'))
			return true;

		//Check Author
		if ($acl->get('core.delete.own'))
		{
			if ($this->isAuthor($record))
				return true;
		}

		return false;
	}

	/**
	* Check if the user can edit the item.
	*
	* @access	public
	* @param	object	$record	A record object.
	* @param	boolean	$testNew	Check canCreate() in case of new element.
	*
	* @return	boolean	True if allowed.
	*/
	public function canEdit($record, $testNew = false)
	{
		$acl = ChronosHelper::getActions();

		//Create instead of Edit if new item
		if($testNew && empty($record->id))
			return self::canCreate();

		//Check if can access
		if (!$this->canAccess($record))
			return false;

		//Check if already edited
		if (!$this->canCheck($record))
			return false;

		if ($acl->get('core.edit'))
			return true;

		//Check Author
		if ($acl->get('core.edit.own'))
		{
			if ($this->isAuthor($record))
				return true;
		}

		return false;
	}

	/**
	* Check if the user can set default the item.
	*
	* @access	public
	* @param	object	$record	A record object.
	*
	* @return	boolean	True if allowed.
	*/
	public function canEditDefault($record)
	{
				//Uses the same ACL than edit state
		return $this->canEditState();
	}

	/**
	* Check if the user can edit this item.
	*
	* @access	public
	* @param	object	$record	A record object.
	*
	* @return	boolean	True if allowed.
	*/
	public function canEditState($record)
	{
		$acl = ChronosHelper::getActions();

		//Check if can access
		if (!$this->canAccess($record))
			return false;

		//Check if already edited
		if (!$this->canCheck($record))
			return false;

		if ($acl->get('core.edit.state'))
			return true;
		
		return false;
	}

	/**
	* Check if the user can view the item.
	*
	* @access	public
	* @param	object	$record	A record object.
	*
	* @return	boolean	True if allowed.
	*/
	public function canView($record)
	{
		$acl = ChronosHelper::getActions();

		//Check if can access
		if (!$this->canAccess($record))
			return false;

		//Check Author
		if ($acl->get('core.view.own'))
		{
			if ($this->isAuthor($record))
				return true;
		}

		//Check Published visibility
		if (!$this->isVisible($record))
			return false;

		return true;
	}

	/**
	* Delete the files assiciated to the items
	*
	* @access	public
	* @param	array	$pks	Ids of the items to delete the images
	* @param	array	$fileFields	Images indexes fields of the table where to find the images paths.
	*
	* @return	boolean	True on success
	*/
	public function deletefiles($pks, $fileFields)
	{
		if (!count($fileFields) || !count($pks))
			return;

		JArrayHelper::toInteger($pks);
		$db = JFactory::getDBO();

		$errors = false;
		$table = $this->getTable();

		//Get all indexes for all fields
		$query = "SELECT " . $db->quoteName(implode($db->quoteName(', '), array_keys($fileFields)))
			. " FROM " . $db->quoteName($table->getTableName())
			. ' WHERE id IN ( '.implode(', ', $pks) .' )';
		$db->setQuery($query);
		$files = $db->loadObjectList();

		cimport("classes.file");
		$config	= JComponentHelper::getParams( 'com_chronos' );

		foreach($fileFields as $fieldName => $op)
		{
			$dir = $config->get('upload_dir_' . $this->view_list . '_' . $fieldName, '[COM_SITE]' .DS. 'files' .DS. $this->view_list . '_' . $fieldName);


			foreach($files as $fileObj)
			{
				$imagePath = $fileObj->$fieldName;
				if (!preg_match("/\[.+\]/", $imagePath))
					$imagePath = $dir .DS. $imagePath;
				if (!ChronosFile::deleteFile($imagePath, $op))
					$errors = true;

			}
		}

		return !$errors;
	}

	/**
	* Method to get the form.
	*
	* @access	public
	* @param	array	$data	An optional array of data for the form to interrogate.
	* @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	*
	* @return	JForm	A JForm object on success, false on failure
	*
	* @since	11.1
	*/
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm($this->context, $this->view_item, array('control' => 'jform','load_data' => true));
		if (empty($form))
			return false;

		$form->addRulePath(JPATH_ADMIN_CHRONOS .DS. 'models' .DS . 'rules');

		$id = $this->getState($this->getName() . '.id');
		$item = $this->_item[$id];

		$this->populateParams($item);
		$this->populateObjects($item);

		return $form;
	}

	/**
	* Method to get the id.
	*
	* @access	public
	*
	* @return	int	The item id. Null if no item loaded.
	*
	* @since	11.1
	*/
	public function getId()
	{
		if (isset($this->_item))
			return $this->getState($this->getName() . '.id');

		return 0;
	}

	/**
	* Method to get an item data.
	*
	* @access	public
	* @param	integer	$pk	The primary id key of the item
	*
	* @return	mixed	Item data object on success, false on failure.
	*/
	public function getItem($pk = null)
	{
		// Initialise variables.
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');

		if ($this->_item === null) {
			$this->_item = array();
		}

		if (!isset($this->_item[$pk])) {

			try
			{
				if (empty($pk))
					$data = new stdClass();
				else
				{
					//Increment the hits if needed
					$this->hit();


					$db = $this->getDbo();
					$query = $db->getQuery(true);

					//Preparation of the query
					$this->prepareQuery($query, $pk);

					$db->setQuery($query);

					$data = $db->loadObject();

					if ($error = $db->getErrorMsg()) {
						throw new Exception($error);
					}
				}

				if (empty($data)) {
					return JError::raiseError(404, JText::_('LANG_NOT_FOUND'));
				}

				$this->populateParams($data);
				$this->populateObjects($data);

				$this->_item[$pk] = $data;

			}
			catch (JException $e)
			{
				if ($e->getCode() == 404) {
					// Need to go thru the error handler to allow Redirect to work.
					JError::raiseError(404, $e->getMessage());
				}
				else {
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
	}

	/**
	* Returns the alias of the list model.
	*
	* @access	public
	* @return	void
	*
	* @since	Cook 2.0
	*/
	public function getNameList()
	{
		return $this->viewList;
	}

	/**
	* Method to increment hits when necessary (check session and layout)
	*
	* @access	public
	* @param	array	$layouts	List of authorized layouts for hitting the object
	*
	* @return	boolean	Null if skipped. True when incremented. False if error.
	*/
	public function hit($layouts = null)
	{
		//Not been overrided in this model (no hit function)
		if (!$layouts)
			return;

		$name = $this->getName();
		$context = $this->getState('context');

		//Search if this item is requested from an item layout
		$found = false;
		foreach($layouts as $layout)
			if ($context == ($name . '.' . $layout))
				$found = true;

		//This layout is not an item layout context
		if (!$found)
			return;

		//Search if the user already loaded this item.
		$id = $this->getState($name . '.id');

		$app = JFactory::getApplication();
		$hits = $app->getUserState($this->context . '.hits', array());


		//This item has already been seen during this session
		if (in_array($id, $hits))
			return;

		$hits[] = $id;

		//Increment the hits
		$table = $this->getTable();
		if (!$table->hit($id))
			return false;

		$app->setUserState($this->context . '.hits', $hits);

		return true;
	}

	/**
	* Method to cascad delete items.
	*
	* @access	public
	* @param	string	$key	The foreign key which relate to the cids.
	* @param	array	$cid	The deleted ids of foreign table.
	*
	* @return	boolean	True on success
	*/
	public function integrityDelete($key, $cid = array())
	{
		if (count( $cid ))
		{
			$db = JFactory::getDBO();
			$table = $this->getTable();
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
			$query = 'SELECT id FROM ' . $db->quoteName($table->getTableName())
				. " WHERE `" . $key . "` IN ( " . $cids . " )";
			$db->setQuery($query);
			$list = $db->loadObjectList();

			$cidsDelete = array();
			if (count($list) > 0)
				foreach($list as $item)
					$cidsDelete[] = $item->id;

			//using the model, the integrities can be chained.
			return $this->delete($cidsDelete);

		}

		return true;
	}

	/**
	* Method to reset foreign keys.
	*
	* @access	public
	* @param	string	$key	The foreign key which relate to the cids.
	* @param	array	$cid	The deleted ids of foreign table.
	*
	* @return	boolean	True on success
	*/
	public function integrityReset($key, $cid = array())
	{
		if (count( $cid ))
		{
			$db = JFactory::getDBO();
			$table = $this->getTable();

			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
			$query = 'UPDATE ' . $db->quoteName($table->getTableName())
				.	' SET ' . $db->quoteName($key) . ' = 0'
				. ' WHERE ' . $db->quoteName($key) . ' IN ( ' . $cids . ' )';
			$db->setQuery( $query );

			if(!$db->query()) {
				JError::raiseWarning(1100, $db->getErrorMsg());
				return false;
			}
		}
		return true;
	}

	/**
	* Method to check is the current user is the author (or can be the author).
	*
	* @access	protected
	* @param	object	$record	A record object.
	*
	* @return	boolean	True if allowed.
	*/
	protected function isAuthor($record)
	{
		$keyAuthor = 'created_by';
		if (property_exists($record, $keyAuthor))
		{
			if ($record->$keyAuthor === null)
				return true;

			if ($record->$keyAuthor == JFactory::getUser()->get('id'))
				return true;

			return false;
		}
		return true;
	}

	/**
	* Method to check is the visibility of the item.
	*
	* @access	protected
	* @param	object	$record	A record object.
	*
	* @return	boolean	True if allowed.
	*/
	protected function isVisible($record)
	{
		$acl = ChronosHelper::getActions();
		
		if ($acl->get('core.edit.state'))
			return true;

		//Check the published state
		$keyAuthor = 'published';
		if (property_exists($record, $keyAuthor))
		{
			//TODO ACL : edit.state
			switch($record->$keyAuthor)
			{
				case 1:
					return true;
					break;

				case null:
				default:
					return false;
					break;
			}
		}
		
		return true;
	}

	/**
	* Method to set default to the item.
	*
	* @access	public
	* @param	int	$id	Id of the item to become default.
	* @param	varchar	$field	Default field name.
	* @param	string	$where	Distinct the defaulting basing on this condition.
	*
	* @return	boolean	True on success. False if error.
	*/
	public function makeDefault($id, $field = 'default', $where = '')
	{
		$table = $this->getTable();

		if (!$table->load($id))
			return false;

		if (!$this->canEditDefault($table))
			return false;

		$pk = $table->getKeyName();

		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$query->update($db->quoteName($table->getTableName()));
		$query->set($db->quoteName($field) . ' = (' . $db->quoteName($pk) . ' = ' . (int)$id . ' )');

		if (trim($where) != '')
			$query->where($where);

		$db->setQuery($query);
		$db->query();
	}

	/**
	* Prepare some additional derivated objects.
	*
	* @access	public
	* @param	object	&$item	The object to populate.
	* @return	void
	*/
	public function populateObjects(&$item)
	{

	}

	/**
	* Prepare some additional important values.
	*
	* @access	public
	* @param	object	&$item	The object to populate.
	* @return	void
	*/
	public function populateParams(&$item)
	{
		/*  TODO
		// Convert parameter fields to objects.
				$registry = new JRegistry;
				$registry->loadString($data->attribs);

				$data->params = clone $this->getState('params');
				$data->params->merge($registry);

		//Metadata (specific)
				$registry = new JRegistry;
				$registry->loadString($data->metadata);
				$data->metadata = $registry;
		*/

		//$item->params = clone $this->getState('params');
		$item->params = new JObject();

		if ($this->canView($item))
			$item->params->set('access-view', true);

		if ($this->canEdit($item))
			$item->params->set('access-edit', true);

		if ($this->canDelete($item))
			$item->params->set('access-delete', true);

	}

	/**
	* Method to auto-populate the model state.
	*
	* @access	public
	* @param	string	$ordering	
	* @param	string	$direction	
	* @return	void
	*/
	public function populateState($ordering = null, $direction = null)
	{
		// Load id from array from the request.
		$jinput = new JInput;
		$cid = $jinput->get('cid', null, 'ARRAY');

		if (isset($cid) && count($cid))
			$jinput->set('id', $cid[0]);

		parent::populateState($ordering, $direction);

		if (defined('JDEBUG'))
			$_SESSION["Chronos"]["Model"][$this->getName()]["State"] = $this->state;

	}

	/**
	* Method to toggle a value, including integer values
	*
	* @access	public
	* @param	string	$fieldName	The field to increment.
	* @param	integer	$pk	The id of the item.
	* @param	integer	$max	Max possible values (modulo). Reset to 0 when the value is superior to max.
	*
	* @return	boolean	True when changed. False if error.
	*/
	public function toggle($fieldName, $pk = null, $max = 1)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');

		$table = $this->getTable();
		if (!$table->toggle($fieldName, $pk, $max))
		{
			JError::raiseWarning(1106, JText::sprintf("CHRONOS_MODEL_IMPOSSIBLE_TO_TOGGLE", $fieldName));
			return false;
		}

		return true;
	}

	/**
	* Method to validate the form data. 
	*  This override handle the inputs of files types, (Joomla issue when they
	* are required)
	*
	* @access	public
	* @param	object	$form	The form to validate against.
	* @param	array	$data	The data to validate.
	* @param	string	$group	The name of the field group to validate.
	*
	* @return	mixed	Array of filtered data if valid, false otherwise.
	*/
	public function validate($form, $data, $group = null)
	{
		//Get the posted files if this model is concerned by files submission
		// JOOMLA FIX : if missing fields in $_POST -> issue in partial update when required
		$currentData = $this->getItem();
		foreach($currentData as $fieldName => $value)
		{
			$field = $form->getField($fieldName, $group, $value);

			//Skip the ID data (and other fields not in the form)
			if (!$field)
				continue;

			//Missing in $_POST and required
			if (!in_array($fieldName, array_keys($data)) && $field->required)
				//Insert the current object value. (UPDATE)
				$data[$fieldName] = $currentData->$fieldName;
		}


		//JOOMLA FIX : Reformate some field types not handled properly
		foreach($form->getFieldset($group) as $field)
		{
			$value = null;
			if (isset($data[$field->fieldname]))
				$value = $data[$field->fieldname];

			switch($field->type)
			{
				//JOOMLA FIX : Reformate the date/time format comming from the post
				case 'ckcalendar':

					cimport('helpers.dates');

					if ($value && (string)$field->format && !ChronosHelperDates::isNull((string)$value) )
					{
						$time = ChronosHelperDates::getSqlDate($value, array($field->format));
						if ($time === null){
							JError::raiseWarning(1203, JText::sprintf('CHRONOS_VALIDATOR_WRONG_DATETIME_FORMAT_FOR_PLEASE_RETRY', $field->label));
							$valid = false;
						}
						else
							$data[$field->fieldname] = $time->toMySQL();
					}
					break;


				//JOOMLA FIX : Apply a null value if the field is in the form
				case 'ckcheckbox':
					if (!$value)
						$data[$field->fieldname] = 0;
					break;
			}
		}


		// JOOMLA FIX : always missing file names in $_POST -> issue when required
		//Get the posted files if this model is concerned by files submission
		if (count($this->fileFields))
		{
			$fileInput = new JInput($_FILES);
			$files = $fileInput->get('jform', null, 'array');

			if (count($files['name']))
			foreach($files['name'] as $fieldName => $value)
			{
				//For required files, temporary insert the value comming from $_FILES
				if (!empty($value))
				{
					$field = $form->getField($fieldName, $group);
					if ($field->required)
						$data[$fieldName] = $value;
				}
			}
		}

		//Exec the native PHP validation (rules)
		$result = parent::validate($form, $data, $group);

		//check the result before to go further
		if ($result === false)
			return false;

		//ID key follower (in some case, ex : save2copy task)
		if (isset($data['id']))
			$result['id'] = $data['id'];

		return $result;
	}


}



