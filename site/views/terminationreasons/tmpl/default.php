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
<?php /* TODO : REMOVE ME */
	echo JDom::_('html.fly.cook.todo', array(
		'message' => '<strong>TODO</strong> : Edit this template and remove me.'
	));

?>
<?php echo(JFactory::getApplication()->get('JComponentTitle')); ?>
<form action="<?php echo(JRoute::_("index.php")); ?>" method="post" name="adminForm" id="adminForm">



		<div>
			<?php echo JDom::_('html.toolbar', array(
												"bar" => JToolBar::getInstance('toolbar')
												));
			?>
			<?php echo $this->loadTemplate('grid'); ?>
		</div>









	<?php 
		$jinput = new JInput;
		echo JDom::_('html.form.footer', array(
		'values' => array(
					'view' => $jinput->get('view', 'terminationreasons'),
					'layout' => $jinput->get('layout', 'default'),
					'boxchecked' => '0',
					'filter_order' => $this->escape($this->state->get('list.ordering')),
					'filter_order_Dir' => $this->escape($this->state->get('list.direction'))
				)));
	?>
</form>
<?php /* TODO : REMOVE ME */
	echo JDom::_('html.fly.cook.todo', array(
		'file' => __FILE__,
		'align' => 'left'
	));

?>
