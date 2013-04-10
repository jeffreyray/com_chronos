<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Employees
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

			<th style="text-align:left">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_NUMBER", 'a.number', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:left">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_FIRST_NAME", 'a.first_name', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:left">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_LAST_NAME", 'a.last_name', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:left">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_FACILITY", '_facility_.label', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:left">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_POSITION", '_position_.label', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_HIRE_DATE", 'a.hire_date', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:center">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_ACTIVE", 'a.active', $listDirn, $listOrder ); ?>
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

            <td style="text-align:left">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'number',
												'dataObject' => $row,
												'route' => array('view' => 'employee','layout' => 'view','cid[]' => $row->id)
												));
				?>
			</td>

            <td style="text-align:left">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'first_name',
												'dataObject' => $row,
												'route' => array('view' => 'employee','layout' => 'view','cid[]' => $row->id)
												));
				?>
			</td>

            <td style="text-align:left">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'last_name',
												'dataObject' => $row,
												'route' => array('view' => 'employee','layout' => 'view','cid[]' => $row->id)
												));
				?>
			</td>

            <td style="text-align:left">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => '_facility_label',
												'dataObject' => $row
												));
				?>
			</td>

            <td style="text-align:left">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => '_position_label',
												'dataObject' => $row
												));
				?>
			</td>

            <td style="text-align:center">
				<?php echo JDom::_('html.grid.datetime', array(
										'dataKey' => 'hire_date',
										'dataObject' => $row,
										'dateFormat' => "%Y-%m-%d"
											));
				?>
			</td>

            <td style="text-align:center">
				<?php echo JDom::_('html.grid.task.toggle', array(
										'dataKey' => 'active',
										'dataObject' => $row,
										'num' => $i,
										'ctrl' => 'employee',
										'commandAcl' => ($row->params->get('access-edit')?null:'core.edit')
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
