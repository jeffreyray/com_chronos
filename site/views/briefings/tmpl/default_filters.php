<?php

/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <    Generated with Cook Self Service  V2.0     |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		2.5
* @package		Chronos
* @subpackage	Briefings
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
	if ($('filter_search_1') != null)
	    $('filter_search_1').value='';
	if ($('filter_search_2') != null)
	    $('filter_search_2').value='';
	if ($('filter_active') != null)
	    $('filter_active').value='';
	if ($('filter_last_used_from') != null)
		$('filter_last_used_from').value='';
	if ($('filter_last_used_to') != null)
		$('filter_last_used_to').value='';


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
			<!-- SEARCH : filter_search_1 : search on Title  -->

				<div class='search filter filter_search_1'>

					<?php echo JDom::_('html.form.input.search', array(
											'domId' => 'filter_search_1',
											'dataKey' => 'filter_search_1',
											'dataValue' => $this->filters['search_1']->value
												));


						?>
				</div>


		</div>
		<div style="float:left">
			<!-- SEARCH : filter_search_2 : search on Description  -->

				<div class='search filter filter_search_2'>

					<?php echo JDom::_('html.form.input.search', array(
											'domId' => 'filter_search_2',
											'dataKey' => 'filter_search_2',
											'dataValue' => $this->filters['search_2']->value
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
			<!-- RANGE : Last used  -->

				<div class='filter range filter_last_used'>
		

					<?php echo JDom::_('html.form.input.range', array(
												'rangeNameSpace' => 'html.form.input.calendar',
												'dataKey' => 'filter_last_used',
												'dataValueFrom' => $this->filters['last_used']->from,
												'dataValueTo' => $this->filters['last_used']->to,
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
