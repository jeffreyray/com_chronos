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



?>
<fieldset class="fieldsform">
	<table class="admintable">
		<dt>
			<label for="_employee_number">
				<?php echo JText::_( "CHRONOS_FIELD_EMPLOYEE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_employee_number',
											'dataObject' => $this->item,
											'route' => array('view' => 'employee','layout' => 'view','cid[]' => $this->item->employee)
											));
			?>
		</dd>
		<dt>
			<label for="_reason_label">
				<?php echo JText::_( "CHRONOS_FIELD_REASON" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_reason_label',
											'dataObject' => $this->item,
											'route' => array('view' => 'wagereason','layout' => 'view','cid[]' => $this->item->reason)
											));
			?>
		</dd>
		<dt>
			<label for="date_effective">
				<?php echo JText::_( "CHRONOS_FIELD_DATE_EFFECTIVE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'date_effective',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>
		<dt>
			<label for="value">
				<?php echo JText::_( "CHRONOS_FIELD_VALUE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'value',
											'dataObject' => $this->item
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
