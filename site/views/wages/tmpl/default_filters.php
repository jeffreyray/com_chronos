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
	if ($('filter_employee_facility') != null)
	    $('filter_employee_facility').value='';
	if ($('filter_reason') != null)
	    $('filter_reason').value='';
	if ($('filter_date_effective_from') != null)
		$('filter_date_effective_from').value='';
	if ($('filter_date_effective_to') != null)
		$('filter_date_effective_to').value='';
	if ($('filter_seach_comment') != null)
	    $('filter_seach_comment').value='';


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
			<!-- SEARCH : filter_seach_comment : search on Comment  -->

				<div class='search filter filter_seach_comment'>

					<?php echo JDom::_('html.form.input.search', array(
											'domId' => 'filter_seach_comment',
											'dataKey' => 'filter_seach_comment',
											'dataValue' => $this->filters['seach_comment']->value
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
			<!-- AJAX :   -->

				<div class='filter filter_employee'>
		
					<?php
						$filter = $this->filters['employee'];
						echo JDom::_('html.form.input.ajax', array(
													'dataKey' => 'filter_employee',
													'dataValue' => $filter->values[0],
													'ajaxContext' => 'chronos.facilities.ajax.filter1',
													'ajaxVars' => array('values' => $filter->values)
													));
					?>
				</div>


		</div>
		<div style="float:left">
			<!-- SELECT : Reason > Label  -->

				<div class='filter filter_reason'>
		
					<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_reason',
											'dataValue' => (string)$this->filters['reason']->value,
											'list' => $this->filters['reason']->list,
											'labelKey' => 'label',
											'nullLabel' => "CHRONOS_FILTER_NULL_REASON",
											'submitEventName' => 'onchange'
												));

						?>
				</div>



		</div>
		<div style="float:left">
			<!-- RANGE : Date Effective  -->

				<div class='filter range filter_date_effective'>
		

					<?php echo JDom::_('html.form.input.range', array(
												'rangeNameSpace' => 'html.form.input.calendar',
												'dataKey' => 'filter_date_effective',
												'dataValueFrom' => $this->filters['date_effective']->from,
												'dataValueTo' => $this->filters['date_effective']->to,
												'labelFrom' => "CHRONOS_JSEARCH_FROM",
												'labelTo' => "CHRONOS_JSEARCH_TO",
												'size' => 10,
												'alignHz' => true,
												'submitEventName' => 'onchange',
												'styles' => array('width' => '80px'),
												'dateFormat' => '%Y-%m-%d'
													));
					?>
				</div>


		</div>
	</div>




	<div clear='all'></div>





</fieldset>
