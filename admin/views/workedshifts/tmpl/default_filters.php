<?php

/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Workedshifts
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
	if ($('filter_facility') != null)
	    $('filter_facility').value='';
	if ($('filter_employee') != null)
	    $('filter_employee').value='';
	if ($('filter_time_in_from') != null)
		$('filter_time_in_from').value='';
	if ($('filter_time_in_to') != null)
		$('filter_time_in_to').value='';


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
				<div class="filter filter_buttons">
					<button onclick="this.form.submit();"><?php echo(JText::_("JSEARCH_FILTER_SUBMIT")); ?></button>
					<button onclick="resetFilters()"><?php echo(JText::_("JSEARCH_FILTER_CLEAR")); ?></button>
				</div>
		</div>
	</div>

	<div>
		<div style="float:left">
			<!-- SELECT : Facility > Label  -->

				<div class='filter filter_facility'>
		
					<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_facility',
											'dataValue' => (string)$this->filters['facility']->value,
											'list' => $this->filters['facility']->list,
											'labelKey' => 'label',
											'nullLabel' => "CHRONOS_FILTER_NULL_FACILITY",
											'submitEventName' => 'onchange'
												));

						?>
				</div>



		</div>
		<div style="float:left">
			<!-- SELECT : Employee > Number  -->

				<div class='filter filter_employee'>
		
					<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_employee',
											'dataValue' => (string)$this->filters['employee']->value,
											'list' => $this->filters['employee']->list,
											'labelKey' => 'number',
											'nullLabel' => "CHRONOS_FILTER_NULL_EMPLOYEE",
											'submitEventName' => 'onchange'
												));

						?>
				</div>



		</div>
		<div style="float:left">
			<!-- RANGE : Time in  -->

				<div class='filter range filter_time_in'>
					<label class='filter' for="filter_time_in"><?php echo(JText::_("CHRONOS_JSEARCH_TIME_IN")); ?> :</label>

					<?php echo JDom::_('html.form.input.range', array(
												'rangeNameSpace' => 'html.form.input.calendar',
												'dataKey' => 'filter_time_in',
												'dataValueFrom' => $this->filters['time_in']->from,
												'dataValueTo' => $this->filters['time_in']->to,
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
