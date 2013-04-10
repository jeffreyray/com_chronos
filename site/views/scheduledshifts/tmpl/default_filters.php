<?php

/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Scheduledshifts
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

defined('_JEXEC') or die('Restricted access'); ?>

<script language="javascript" type="text/javascript">
<!--


function resetFilters()
{
	if (typeof(jQuery) != 'undefined')
	{
		jQuery('.filters :input').val('');

	/* TODO : Uncomment this if you want that the reset action proccess also on sorting values
		jQuery('#filter_order').val('');
		jQuery('#filter_orderDir').val('');
	*/
		document.adminForm.submit();
		return;
	}

//Deprecated
	if ($('filter_employee') != null)
	    $('filter_employee').value='';
	if ($('filter_shift_type') != null)
	    $('filter_shift_type').value='';
	if ($('filter_start_from') != null)
		$('filter_start_from').value='';
	if ($('filter_start_to') != null)
		$('filter_start_to').value='';
	if ($('filter_search') != null)
	    $('filter_search').value='';


/* TODO : Uncomment this if you want that the reset action proccess also on sorting values
	if ($('filter_order') != null)
	    $('filter_order').value='';
	if ($('filter_orderDir') != null)
	    $('filter_orderDir').value='';
*/

	document.adminForm.submit();
}

-->
</script>


<fieldset id="filters" class="filters">
	<legend><?php echo JText::_( "JSEARCH_FILTER_LABEL" ); ?></legend>



	<div style="float:right;">
		<div style="float:left">
			<!-- SEARCH : filter_search : search on Comment  -->

				<div class='search filter filter_search'>

					<?php echo JDom::_('html.form.input.search', array(
											'domId' => 'filter_search',
											'dataKey' => 'filter_search',
											'dataValue' => $this->filters['search']->value
												));


						?>
				</div>


		</div>
		<div style="float:left">
				<div class="filter filter_buttons">
					<button onclick="this.form.submit();"><?php echo(JText::_("JSEARCH_FILTER_SUBMIT")); ?></button>
					<button onclick="resetFilters()"><?php echo(JText::_("JSEARCH_FILTER_CLEAR")); ?></button>
				</div>
		</div>
	</div>

	<div>
		<div style="float:left">
			<!-- SELECT : Employee > First Name  -->

				<div class='filter filter_employee'>
		
					<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_employee',
											'dataValue' => (string)$this->filters['employee']->value,
											'list' => $this->filters['employee']->list,
											'labelKey' => 'first_name',
											'nullLabel' => "CHRONOS_FILTER_NULL_EMPLOYEE_FIRST_NAME",
											'submitEventName' => 'onchange'
												));

						?>
				</div>



		</div>
		<div style="float:left">
			<!-- SELECT : Shift Type > Label  -->

				<div class='filter filter_shift_type'>
		
					<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_shift_type',
											'dataValue' => (string)$this->filters['shift_type']->value,
											'list' => $this->filters['shift_type']->list,
											'labelKey' => 'label',
											'nullLabel' => "CHRONOS_FILTER_NULL_SHIFT_TYPE_LABEL",
											'submitEventName' => 'onchange'
												));

						?>
				</div>



		</div>
		<div style="float:left">
			<!-- RANGE : Start  -->

				<div class='filter range filter_start'>
		

					<?php echo JDom::_('html.form.input.range', array(
												'rangeNameSpace' => 'html.form.input.calendar',
												'dataKey' => 'filter_start',
												'dataValueFrom' => $this->filters['start']->from,
												'dataValueTo' => $this->filters['start']->to,
												'labelFrom' => "CHRONOS_JSEARCH_FROM",
												'labelTo' => "CHRONOS_JSEARCH_TO",
												'size' => 10,
												'alignHz' => true,
												'submitEventName' => 'onchange',
												'styles' => array('width' => '80px'),
												'dateFormat' => '%Y-%m-%d %H:%M'
													));
					?>
				</div>


		</div>
	</div>




	<div clear='all'></div>





</fieldset>
