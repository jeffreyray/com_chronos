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
defined( '_JEXEC' ) or die( 'Restricted access' );
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);

@define('COM_CHRONOS', 'com_chronos');
@define('JPATH_ADMIN_CHRONOS', JPATH_ADMINISTRATOR . DS . 'components' . DS . COM_CHRONOS);
@define('JPATH_SITE_CHRONOS', JPATH_SITE . DS . 'components' . DS . COM_CHRONOS);
@define('JQUERY', '1.8.2');

//Shortcut to include component libraries
if (!function_exists('cimport')){
	function cimport($namespace, $option = 'com_chronos', $className = null){
		//Check if class already exists
		if (($className) && class_exists($className))
			return;
		@require_once JPATH_ADMINISTRATOR .DS. 'components' .DS. $option . DS . str_replace(".", DS, $namespace) . '.php';
	}
}

require_once(JPATH_ADMIN_CHRONOS .DS.'helpers'.DS.'helper.php');
JHTML::_("behavior.framework");

// Set the table directory
JTable::addIncludePath(JPATH_ADMIN_CHRONOS . DS . 'tables');

//Document title
$document	= &JFactory::getDocument();
$document->titlePrefix = "Chronos - ";
$document->titleSuffix = "";

if (defined('JDEBUG') && count($_POST))
	$_SESSION['Chronos']['$_POST'] = $_POST;

$jinput = new JInput;
//FILE INDIRECT ACCESS
$task = $jinput->get('task', null, 'CMD');
if ($task == 'file')
{
	require_once(JPATH_ADMIN_CHRONOS .DS. "classes" .DS. "file.php");
	ChronosFile::returnFile('db');
}

jimport('joomla.application.component.controller');

$controller = JController::getInstance('Chronos');
$controller->execute($jinput->get('task', null, 'CMD'));
$controller->redirect();

