<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Projectmanagers
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
			<label for="display_name">
				<?php echo JText::_( "CHRONOS_FIELD_DISPLAY_NAME" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'display_name',
											'dataObject' => $this->item
											));
			?>
		</dd>
		<dt>
			<label for="email">
				<?php echo JText::_( "CHRONOS_FIELD_EMAIL" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'email',
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
			<label for="creation_date">
				<?php echo JText::_( "CHRONOS_FIELD_CREATION_DATE" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'creation_date',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>

	</table>
</fieldset>
