<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Terminationreasons
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
			<label for="label">
				<?php echo JText::_( "CHRONOS_FIELD_LABEL" ); ?> :
			</label>
		</dt>
		<dd>
			<?php echo JDom::_('html.fly', array(
											'dataKey' => 'label',
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

	</table>
</fieldset>
