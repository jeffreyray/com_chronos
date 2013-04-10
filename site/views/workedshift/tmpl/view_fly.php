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



?>
<fieldset class="fieldsform">
	<table class="admintable">
		<dt>
			<label for="_employee_first_name">
				<?php echo JText::_( "CHRONOS_FIELD_EMPLOYEE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_employee_first_name',
											'dataObject' => $this->item,
											'route' => array('view' => 'employee','layout' => 'view','cid[]' => $this->item->employee)
											));
			?>
		</dd>
		<dt>
			<label for="_facility_label">
				<?php echo JText::_( "CHRONOS_FIELD_FACILITY" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_facility_label',
											'dataObject' => $this->item,
											'route' => array('view' => 'facility','layout' => 'view','cid[]' => $this->item->facility)
											));
			?>
		</dd>
		<dt>
			<label for="time_in">
				<?php echo JText::_( "CHRONOS_FIELD_TIME_IN" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'time_in',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d %H:%M"
											));

			?>
		</dd>
		<dt>
			<label for="time_out">
				<?php echo JText::_( "CHRONOS_FIELD_TIME_OUT" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'time_out',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d %H:%M"
											));

			?>
		</dd>
		<dt>
			<label for="break_length">
				<?php echo JText::_( "CHRONOS_FIELD_BREAK_LENGTH" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'break_length',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="_scheduled_shift_start">
				<?php echo JText::_( "CHRONOS_FIELD_SCHEDULED_SHIFT" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => '_scheduled_shift_start',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d %H:%M"
											));

			?>
		</dd>
		<dt>
			<label for="comment">
				<?php echo JText::_( "CHRONOS_FIELD_COMMENT" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'comment',
											'dataObject' => $this->item
											));
			?>
		</dd>

	</table>
</fieldset>
