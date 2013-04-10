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



?>
<fieldset class="fieldsform">
	<dl>
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
			<label for="title">
				<?php echo JText::_( "CHRONOS_FIELD_TITLE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'title',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="_umbrella_title">
				<?php echo JText::_( "CHRONOS_FIELD_UMBRELLA" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_umbrella_title',
											'dataObject' => $this->item,
											'route' => array('view' => 'umbrella','layout' => 'view','cid[]' => $this->item->umbrella)
											));
			?>
		</dd>
		<dt>
			<label for="_client_name">
				<?php echo JText::_( "CHRONOS_FIELD_CLIENT" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_client_name',
											'dataObject' => $this->item,
											'route' => array('view' => 'client','layout' => 'client','cid[]' => $this->item->client)
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
			<label for="_briefing_title">
				<?php echo JText::_( "CHRONOS_FIELD_BRIEFING" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_briefing_title',
											'dataObject' => $this->item,
											'route' => array('view' => 'briefing','layout' => 'view','cid[]' => $this->item->briefing)
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
											'list' => $this->lists['enum']['studies.tier'],
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
			<label for="start_date">
				<?php echo JText::_( "CHRONOS_FIELD_START_DATE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'start_date',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>
		<dt>
			<label for="deadline">
				<?php echo JText::_( "CHRONOS_FIELD_DEADLINE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'deadline',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>
		<dt>
			<label for="finish_date">
				<?php echo JText::_( "CHRONOS_FIELD_FINISH_DATE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'finish_date',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
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
			<label for="display">
				<?php echo JText::_( "CHRONOS_FIELD_DISPLAY" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.bool', array(
											'dataKey' => 'display',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="_primary_manager_display_name">
				<?php echo JText::_( "CHRONOS_FIELD_PRIMARY_MANAGER" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_primary_manager_display_name',
											'dataObject' => $this->item,
											'route' => array('view' => 'projectmanager','layout' => 'view','cid[]' => $this->item->primary_manager)
											));
			?>
		</dd>
		<dt>
			<label for="_secondary_manager_display_name">
				<?php echo JText::_( "CHRONOS_FIELD_SECONDARY_MANAGER" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_secondary_manager_display_name',
											'dataObject' => $this->item,
											'route' => array('view' => 'projectmanager','layout' => 'view','cid[]' => $this->item->secondary_manager)
											));
			?>
		</dd>
		<dt>
			<label for="cati_code">
				<?php echo JText::_( "CHRONOS_FIELD_CATI_CODE_1" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'cati_code',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="cost_code">
				<?php echo JText::_( "CHRONOS_FIELD_COST_CODE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'cost_code',
											'dataObject' => $this->item
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
		<dt>
			<label for="quota">
				<?php echo JText::_( "CHRONOS_FIELD_QUOTA" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'quota',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="target_cph">
				<?php echo JText::_( "CHRONOS_FIELD_TARGET_CPH" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'target_cph',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="target_length">
				<?php echo JText::_( "CHRONOS_FIELD_TARGET_LENGTH" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'target_length',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="target_incidence">
				<?php echo JText::_( "CHRONOS_FIELD_TARGET_INCIDENCE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'target_incidence',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="completes">
				<?php echo JText::_( "CHRONOS_FIELD_COMPLETES" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'completes',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="final_cph">
				<?php echo JText::_( "CHRONOS_FIELD_FINAL_CPH" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'final_cph',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="final_length">
				<?php echo JText::_( "CHRONOS_FIELD_FINAL_LENGTH" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'final_length',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="final_incidence">
				<?php echo JText::_( "CHRONOS_FIELD_FINAL_INCIDENCE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'final_incidence',
											'dataObject' => $this->item
											));
			?>
		</dd>

	</dl>
</fieldset>
