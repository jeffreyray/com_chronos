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



?>
<fieldset class="fieldsform">
	<dl>
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
			<label for="_study_number">
				<?php echo JText::_( "CHRONOS_FIELD_STUDY" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => '_study_number',
											'dataObject' => $this->item,
											'route' => array('view' => 'study','layout' => 'view','cid[]' => $this->item->study)
											));
			?>
		</dd>
		<dt>
			<label for="date">
				<?php echo JText::_( "CHRONOS_FIELD_DATE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'date',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>
		<dt>
			<label for="source">
				<?php echo JText::_( "CHRONOS_FIELD_SOURCE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.enum', array(
											'dataKey' => 'source',
											'dataObject' => $this->item,
											'list' => $this->lists['enum']['productivities.source'],
											'listKey' => 'value',
											'labelKey' => 'text'
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
			<label for="calls">
				<?php echo JText::_( "CHRONOS_FIELD_CALLS" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'calls',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="duration">
				<?php echo JText::_( "CHRONOS_FIELD_DURATION" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'duration',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="cati_code">
				<?php echo JText::_( "CHRONOS_FIELD_CATI_CODE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'cati_code',
											'dataObject' => $this->item
											));
			?>
		</dd>

	</dl>
</fieldset>
