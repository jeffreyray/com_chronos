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


JHtml::addIncludePath(JPATH_ADMIN_CHRONOS.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$model		= $this->model;
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'a.ordering';
?>

<div class="grid_wrapper">
	<table id='grid' class='adminlist' cellpadding="0" cellspacing="0">
	<thead>
		<tr>


			<th align="left">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_DATE", 'a.date', $listDirn, $listOrder ); ?>
			</th>

			<th align="center">
				<?php echo JText::_("ID"); ?>
			</th>
		</tr>
	</thead>

	<tbody>
	<?php

	$function	= JFactory::getApplication()->input->get('function', 'jSelectItem', 'cmd');
	$k = 0;

	for ($i=0, $n=count( $this->items ); $i < $n; $i++):

		$row = &$this->items[$i];



		?>


		<tr class="<?php echo "row$k"; ?>"
			style="cursor:pointer"
			onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $row->id; ?>', '<?php echo $this->escape(addslashes($row->date)); ?>', 'cid');">



			<td align="left">
				<?php echo $row->date; ?>
			</td>

            <td align="center">
				<?php echo $row->id; ?>
			</td>

		</tr>
		<?php
		$k = 1 - $k;

	endfor;
	?>
	</tbody>
	</table>
</div>

<?php echo JDom::_('html.pagination', null, $this->pagination);?>
