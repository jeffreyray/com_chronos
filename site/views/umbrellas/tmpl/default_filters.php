<?php

/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Umbrellas
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
	if ($('filter_active') != null)
	    $('filter_active').value='';
	if ($('filter_facility') != null)
	    $('filter_facility').value='';
	if ($('filter_client') != null)
	    $('filter_client').value='';
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
			<!-- SEARCH : filter_search : search on Title  -->

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
			<!-- SELECT : Active  -->

					<div class='filter filter_active'>
			
						<?php
						$choices = array();
						$choices[] = array("value" => null, 'text'=>JText::_( "CHRONOS_FILTER_NULL_ACTIVE" ));
						$choices[] = array("value" => '0', 'text'=>JText::_( "JNO" ));
						$choices[] = array("value" => '1', 'text'=>JText::_( "JYES" ));

						echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_active',
											'dataValue' => $this->filters['active']->value,
											'list' => $choices,
											'listKey' => 'value',
											'labelKey' => 'text',
											'submitEventName' => 'onchange'
												));

						?>
					</div>


		</div>
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
			<!-- SELECT : Client > Name  -->

				<div class='filter filter_client'>
		
					<?php echo JDom::_('html.form.input.select', array(
											'dataKey' => 'filter_client',
											'dataValue' => (string)$this->filters['client']->value,
											'list' => $this->filters['client']->list,
											'labelKey' => 'name',
											'nullLabel' => "CHRONOS_FILTER_NULL_CLIENT",
											'submitEventName' => 'onchange'
												));

						?>
				</div>



		</div>
	</div>




	<div clear='all'></div>





</fieldset>
