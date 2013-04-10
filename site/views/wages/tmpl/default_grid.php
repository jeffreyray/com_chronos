<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Wages
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

			<th style="text-align:left" width="4%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_", '_employee_.number', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:left" width="10%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_FIRST", '_employee_.first_name', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:left" width="10%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_LAST", '_employee_.last_name', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:left" width="15%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_REASON", '_reason_.label', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:right" width="10%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_VALUE", 'a.value', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:center" width="10%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_DATE_EFFECTIVE", 'a.date_effective', $listDirn, $listOrder ); ?>
			</th>

			<th style="text-align:left" width="35%">
				<?php echo JHTML::_('grid.sort',  "CHRONOS_FIELD_COMMENT", 'a.comment', $listDirn, $listOrder ); ?>
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

            <td style="text-align:left" width="4%">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => '_employee_number',
												'dataObject' => $row
												));
				?>
			</td>

            <td style="text-align:left" width="10%">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => '_employee_first_name',
												'dataObject' => $row
												));
				?>
			</td>

            <td style="text-align:left" width="10%">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => '_employee_last_name',
												'dataObject' => $row
												));
				?>
			</td>

            <td style="text-align:left" width="15%">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => '_reason_label',
												'dataObject' => $row
												));
				?>
			</td>

            <td style="text-align:right" width="10%">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'value',
												'dataObject' => $row,
												'href' => "javascript:listItemTask('cb" . $i . "', 'wage.edit')"
												));
				?>
			</td>

            <td style="text-align:center" width="10%">
				<?php echo JDom::_('html.grid.datetime', array(
										'dataKey' => 'date_effective',
										'dataObject' => $row,
										'dateFormat' => "%Y-%m-%d",
												'href' => "javascript:listItemTask('cb" . $i . "', 'wage.edit')"
											));
				?>
			</td>

            <td style="text-align:left" width="35%">
				<?php echo JDom::_('html.fly', array(
												'dataKey' => 'comment',
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
