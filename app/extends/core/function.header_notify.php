<?php
/**
 * @category   Smarty Plugin
 * @package    MAGIX CMS
 * @copyright  Copyright (c) 2009 - 2010 (http://www.magix-cms.com)
 * @license    Proprietary software
 * @version    1.0 2010-09-07
 * @author Gérits Aurélien <gerits.aurelien@gmail.com>
 *
 */
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */
/**
 * Smarty {header_notify} function plugin
 *
 * Type:     function
 * Name:     notify
 * Date:     September 09 2010
 * 
 * Purpose:  
 * Examples: {header_notify}
 * Output:   HTML
 * @link 
 * @author   Gerits Aurelien
 * @version  0.1
 * @param params
 * @param Smarty
 * @return string
 */
function smarty_function_header_notify($params, &$smarty){
	$text = $params['text'];
	if(!empty($text)){
	return <<<EOT
	<div id="notify-header">
		<a href="#" class="close-notify ui-state-default ui-corner-all"><span style="float:left;" class="ui-icon ui-icon-closethick"></span>Close</a>	
		<div id="message-notification">
			<div class="mc-rep-request">
				$text
			</div>
		</div>
	</div>
EOT;
	
	}
}