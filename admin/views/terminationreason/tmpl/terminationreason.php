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


ChronosHelper::headerDeclarations();
?>
<script language="javascript" type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#adminForm").validationEngine();
	});

	Joomla.submitform = function(pressbutton)
	{
		//Unlock the page
		holdForm = false;

		var parts = pressbutton.split('.');

		jQuery("#task").val(pressbutton);
		switch(parts[parts.length-1])
		{
			case 'save':
			case 'save2copy':
			case 'save2new':
			case 'apply':
				//Call the validator
				break;

			default:
				jQuery("#adminForm").validationEngine('detach');
				break;
		}

		jQuery("#adminForm").submit();
	}

	//Secure the user navigation on the page, in order preserve datas.
	var holdForm = true;
	window.onbeforeunload = function closeIt(){	if (holdForm) return false;};
</script>

<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm" class='form-validate' enctype='multipart/form-data'>



		<div>
			<?php echo $this->loadTemplate('form'); ?>
		</div>








		<input name="_download" type="hidden" id="_download" value=""/>

	<?php 
		$jinput = new JInput;
		echo JDom::_('html.form.footer', array(
		'dataObject' => $this->item,
		'values' => array(
					'id' => $this->state->get('terminationreason.id')
				)));
	?>
</form>
<?php /* TODO : REMOVE ME */
	echo JDom::_('html.fly.cook.todo', array(
		'file' => __FILE__,
		'align' => 'left'
	));

?>
