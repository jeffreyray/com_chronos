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



?>
<fieldset class="fieldsform">
	<table class="admintable">
		<dt>
			<label for="image">
				<?php echo JText::_( "CHRONOS_FIELD_IMAGE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.file.default', array(
											'dataKey' => 'image',
											'dataObject' => $this->item,
											'width' => 'auto',
											'height' => 'auto',
											'cid' => $this->item->id,
											'view' => 'employee',
											'attrs' => array('format:png'),
											'indirect' => true,
											'root' => '[DIR_EMPLOYEES_IMAGE]'
											));
			?>
		</dd>
		<dt>
			<label for="number">
				<?php echo JText::_( "CHRONOS_FIELD_NUMBER" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'number',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="first_name">
				<?php echo JText::_( "CHRONOS_FIELD_FIRST_NAME" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'first_name',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="middle_name">
				<?php echo JText::_( "CHRONOS_FIELD_MIDDLE_NAME" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'middle_name',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="last_name">
				<?php echo JText::_( "CHRONOS_FIELD_LAST_NAME" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'last_name',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="gender">
				<?php echo JText::_( "CHRONOS_FIELD_GENDER" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.enum', array(
											'dataKey' => 'gender',
											'dataObject' => $this->item,
											'list' => $this->lists['enum']['employees.gender'],
											'listKey' => 'value',
											'labelKey' => 'text'
											));
			?>
		</dd>
		<dt>
			<label for="birth_date">
				<?php echo JText::_( "CHRONOS_FIELD_BIRTH_DATE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'birth_date',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>
		<dt>
			<label for="contact_info">
				<?php echo JText::_( "CHRONOS_FIELD_CONTACT_INFO" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'contact_info',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="active">
				<?php echo JText::_( "CHRONOS_FIELD_ACTIVE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.bool', array(
											'dataKey' => 'active',
											'dataObject' => $this->item
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
			<label for="_position_label">
				<?php echo JText::_( "CHRONOS_FIELD_POSITION" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_position_label',
											'dataObject' => $this->item,
											'route' => array('view' => 'position','layout' => 'viewposition','cid[]' => $this->item->position)
											));
			?>
		</dd>
		<dt>
			<label for="tier">
				<?php echo JText::_( "CHRONOS_FIELD_TIER" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.enum', array(
											'dataKey' => 'tier',
											'dataObject' => $this->item,
											'list' => $this->lists['enum']['employees.tier'],
											'listKey' => 'value',
											'labelKey' => 'text'
											));
			?>
		</dd>
		<dt>
			<label for="tags">
				<?php echo JText::_( "CHRONOS_FIELD_TAGS" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'tags',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="hire_date">
				<?php echo JText::_( "CHRONOS_FIELD_HIRE_DATE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'hire_date',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>
		<dt>
			<label for="alt_hire_date">
				<?php echo JText::_( "CHRONOS_FIELD_ALT_HIRE_DATE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'alt_hire_date',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>
		<dt>
			<label for="passed_probation">
				<?php echo JText::_( "CHRONOS_FIELD_PASSED_PROBATION" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'passed_probation',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>
		<dt>
			<label for="_referral_source_label">
				<?php echo JText::_( "CHRONOS_FIELD_REFERRAL_SOURCE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_referral_source_label',
											'dataObject' => $this->item,
											'route' => array('view' => 'referralsource','layout' => 'view','cid[]' => $this->item->referral_source)
											));
			?>
		</dd>
		<dt>
			<label for="_referrer_first_name">
				<?php echo JText::_( "CHRONOS_FIELD_REFERRER" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_referrer_first_name',
											'dataObject' => $this->item,
											'route' => array('view' => 'employee','layout' => 'view','cid[]' => $this->item->referrer)
											));
			?>
		</dd>
		<dt>
			<label for="termination_date">
				<?php echo JText::_( "CHRONOS_FIELD_TERMINATION_DATE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'termination_date',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>
		<dt>
			<label for="_termination_reason_label">
				<?php echo JText::_( "CHRONOS_FIELD_TERMINATION_REASON" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_termination_reason_label',
											'dataObject' => $this->item,
											'route' => array('view' => 'terminationreason','layout' => 'view','cid[]' => $this->item->termination_reason)
											));
			?>
		</dd>
		<dt>
			<label for="note">
				<?php echo JText::_( "CHRONOS_FIELD_NOTE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'note',
											'dataObject' => $this->item
											));
			?>
		</dd>

	</table>
</fieldset>
