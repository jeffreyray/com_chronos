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
	if ($('filter_study') != null)
	    $('filter_study').value='';
	if ($('filter_study_client') != null)
	    $('filter_study_client').value='';
	if ($('filter_employee') != null)
	    $('filter_employee').value='';
	if ($('filter_employee_facility') != null)
	    $('filter_employee_facility').value='';


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
			<!-- AJAX :   -->

				<div class='filter filter_study'>
					<label class='filter' for="filter_study"><?php echo(JText::_("CHRONOS_JSEARCH_STUDY")); ?> :</label>
					<?php
						$filter = $this->filters['study'];
						echo JDom::_('html.form.input.ajax', array(
													'dataKey' => 'filter_study',
													'dataValue' => $filter->values[0],
													'ajaxContext' => 'chronos.clients.ajax.filter1',
													'ajaxVars' => array('values' => $filter->values)
													));
					?>
				</div>


		</div>
		<div style="float:left">
			<!-- AJAX :   -->

				<div class='filter filter_employee'>
		
					<?php
						$filter = $this->filters['employee'];
						echo JDom::_('html.form.input.ajax', array(
													'dataKey' => 'filter_employee',
													'dataValue' => $filter->values[0],
													'ajaxContext' => 'chronos.facilities.ajax.filter2',
													'ajaxVars' => array('values' => $filter->values)
													));
					?>
				</div>


		</div>
	</div>




	<div clear='all'></div>





</fieldset>
