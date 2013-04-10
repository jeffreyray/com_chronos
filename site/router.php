<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Viewlevels
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

defined('_JEXEC') or die;


/**
 * Build the route for the com_chronos component
 *
 * @param	array	An array of URL arguments
 *
 * @return	array	The URL arguments to use to assemble the subsequent URL.
 */
function ChronosBuildRoute(&$query){

	$segments = array();
	if(isset($query['view']))
	{
		$view = $query['view'];
		$segments[] = $view;
		unset( $query['view'] );
	}

	if(isset($query['layout']))
	{
		$segments[] = $query['layout'];
		unset( $query['layout'] );
	}


	if(isset($query['id']))
	{
		if(in_array($view, array('edit','view','view','editfacility','view','edit','client','editclient','viewposition','editposition','edit','view','edit','view','view','edit','view','edit','view','edit','view','edit')))
		{
			$segments[] = (is_array($query['id'])?implode(',', $query['id']):$query['id']);
			unset( $query['id'] );
		}
	};


	return $segments;
}


/**
 * Parse the segments of a URL.
 *
 * @param	array	The segments of the URL to parse.
 *
 * @return	array	The URL attributes to be used by the application.
 */
function ChronosParseRoute($segments)
{
	$vars = array();


	$vars['view'] = $segments[0];

	$nextPos = 1;
	if (isset($segments[$nextPos]))
	{
		$vars['layout'] = $segments[$nextPos];
		$nextPos++;
	}

	//Item layout : get the cid value
	if(in_array($vars['view'], array('edit','view','view','editfacility','view','edit','client','editclient','viewposition','editposition','edit','view','edit','view','view','edit','view','edit','view','edit','view','edit')) && isset($segments[$nextPos]))
	{
		$slug = $segments[$nextPos];
		$id = explode( ':', $slug );
		$vars['id'] = (int) $id[0];

		$nextPos++;
	}

	return $vars;
}

