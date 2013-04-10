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


			<?php if ($model->canEdit()): ?>
            <th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<?php endif; ?>

			<th style="text-align:center" width="25%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_LABEL", 'a.label', $listDirn, $listOrder ); ?>
			</th>

			<?php if ($this->canDo->get('core.edit.state') || $this->canDo->get('core.view.own')): ?>
			<th style="text-align:center" width="10%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_PUBLISHED", 'a.published', $listDirn, $listOrder ); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->canDo->get('core.edit') || $this->canDo->get('core.edit.state')): ?>
			<th class="order" style="text-align:center" width="10%">
				<?php echo JHTML::_('grid.sort',  'Order', 'a.ordering', $listDirn, $listOrder ); ?>
				<?php echo JHTML::_('grid.order',  $this->items, 'filesave.png', 'terminationreasons.saveorder' ); ?>
			</th>
			<?php endif; ?>

			<th style="text-align:center" width="10%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_DEFAULT", 'a.default', $listDirn, $listOrder ); ?>
			</th>

			<th width="40%">
				<?php echo JText::_("CHRONOS_FIELD_NOTE"); ?>
			</th>



		</tr>
	</thead>

	<tbody>
	<?php
	$k = 0;

	for ($i=0, $n=count( $this->items ); $i < $n; $i++):

		$row = &$this->items[$i];



		?>

		<tr class="<?php echo "row$k"; ?>">



			<?php if ($model->canEdit()): ?>
			<td>
				<?php if ($row->params->get('access-edit') || $row->params->get('tag-checkedout')): ?>
					<?php echo JDom::_('html.grid.checkedout', array(
												'dataObject' => $row,
												'num' => $i
													));
					?>
				<?php endif; ?>

			</td>
			<?php endif; ?>

            <td style="text-align:center" width="25%">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'label',
												'dataObject' => $row,
												'href' => "javascript:listItemTask('cb" . $i . "', 'terminationreason.edit')"
												));
				?>
			</td>

			<?php if ($this->canDo->get('core.edit.state') || $this->canDo->get('core.view.own')): ?>
            <td style="text-align:center" width="10%">
				<?php echo JDom::_('html.grid.task.publish', array(
										'dataKey' => 'published',
										'dataObject' => $row,
										'num' => $i,
										'ctrl' => 'terminationreasons'
											));
				?>
			</td>
			<?php endif; ?>

			<?php if ($this->canDo->get('core.edit') || $this->canDo->get('core.edit.state')): ?>
            <td class="order" style="text-align:center" width="10%">
				<?php echo JDom::_('html.grid.ordering', array(
										'dataKey' => 'ordering',
										'dataObject' => $row,
										'num' => $i,
										'ordering' => $this->state->get('list.ordering'),
										'direction' => $this->state->get('list.direction'),
										'list' => $this->items,
										'ctrl' => 'terminationreasons',
										'ctrl' => 'terminationreasons',
										'pagination' => $this->pagination
											));
				?>
			</td>
			<?php endif; ?>

            <td style="text-align:center" width="10%">
				<?php echo JDom::_('html.grid.bool', array(
										'dataKey' => 'default',
										'dataObject' => $row,
										'num' => $i
											));
				?>
			</td>

            <td width="40%">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'note',
												'dataObject' => $row
												));
				?>
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
