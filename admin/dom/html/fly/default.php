<?php
/**                               ______________________________________________
*                          o O   |                                              |
*                 (((((  o      <     JDom Class - Cook Self Service library    |
*                ( o o )         |______________________________________________|
* --------oOOO-----(_)-----OOOo---------------------------------- www.j-cook.pro --- +
* @version		1.0.0
* @package		Cook Self Service
* @subpackage	JDom
* @license		GNU General Public License
* @author		100% Vitamin - Jocelyn HUARD
*
*	-> You can reuse this framework for all purposes. Keep this signature. <-
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
defined( '_JEXEC' ) or die( 'Restricted access' );


class JDomHtmlFlyDefault extends JDomHtmlFly
{
	var $level = 3;			//Namespace position
	var $last = true;

	private $text;
	private $images;

	/*
	 * Constuctor
	 * 	@namespace 	: requested class
	 *  @options	: Configuration
	 * 	@dataKey	: database field name
	 * 	@dataObject	: complete object row (stdClass or Array)
	 * 	@dataValue	: value  default = dataObject->dataKey
	 *
	 *
	 */
	function __construct($args)
	{
		parent::__construct($args);
	}

	function build()
	{
		$html = "";

		if (isset($this->dataValue))
			$html = $this->dataValue;

		if (count($this->styles) || count($this->classes) || count($this->selectors))
		{
			if (!$this->markup)
				$this->markup = 'span';
		}

		if ($this->markup)
			$html = '<<%MARKUP%><%CLASS%><%STYLE%><%SELECTORS%>>' . $html . '</<%MARKUP%>>';

		return $html;
	}

}