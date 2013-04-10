<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Umbrellas
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


$fieldSets = $this->form->getFieldsets();
?>
<?php $fieldSet = $this->form->getFieldset('umbrella.form');?>
<fieldset class="fieldsform">
	<dl>

	<?php
	// JForms dynamic initialization (Cook Self Service proposal)
	$fieldSet['jform_facility']->jdomOptions = array(
			'list' => $this->lists['fk']['facility']
		);
	$fieldSet['jform_client']->jdomOptions = array(
			'list' => $this->lists['fk']['client']
		);

	// Iterate through the fields and display them.
	foreach($fieldSet as $field):

		//Check ACL
	    if ((method_exists($field, 'canView')) && !$field->canView())
	    	continue;

	    // If the field is hidden, only use the input.
	    if ($field->hidden):
	        echo $field->input;
	    else:
	    ?>
	    <dt>
	        <?php echo $field->label; ?>
	    </dt>
	    <dd<?php echo ($field->type == 'Editor' || $field->type == 'Textarea') ? ' style="clear: both; margin: 0;"' : ''?>>
	        <?php echo $field->input ?>
	    </dd>
	    <?php
	    endif;
	endforeach;
	?>


	</dl>
</fieldset>
