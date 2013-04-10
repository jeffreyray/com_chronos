<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Briefings
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
			<label for="description">
				<?php echo JText::_( "CHRONOS_FIELD_DESCRIPTION" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'description',
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
		<dt>
			<label for="last_used">
				<?php echo JText::_( "CHRONOS_FIELD_LAST_USED" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly.datetime', array(
											'dataKey' => 'last_used',
											'dataObject' => $this->item,
											'dateFormat' => "%Y-%m-%d"
											));

			?>
		</dd>

	</table>
</fieldset>
