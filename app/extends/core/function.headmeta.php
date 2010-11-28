<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of Magix CMS.
# Magix CMS, a CMS optimized for SEO
# Copyright (C) 2010 - 2011  Gerits Aurelien <aurelien@magix-cms.com>
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
# 
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
# -- END LICENSE BLOCK -----------------------------------
/**
 * MAGIX CMS
 * @category   extends 
 * @package    Smarty
 * @subpackage function
 * @copyright  MAGIX CMS Copyright (c) 2010 Gerits Aurelien, 
 * http://www.magix-cms.com, http://www.logiciel-referencement-professionnel.com http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    plugin version
 * @author Gérits Aurélien <aurelien@magix-cms.com>
 *
 */
/**
 * Smarty {headmeta meta=""} function plugin
 *
 * Type:     function
 * Name:     
 * Date:     
 * Purpose:  
 * Examples: {headmeta}
 * Output:   
 * @link 
 * @author   Gerits Aurelien
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_headmeta($params, $template){
	$meta = $params['meta'];
	if (!isset($meta)) {
	 	trigger_error("meta: missing 'meta' parameter");
		return;
	}
	$head = '';
	$ini = new magixcjquery_view_helper_headMeta();
	switch($meta){
		case 'contentType':
			$content = !isset($params['content'])?trigger_error("content: missing 'content' parameter"):$params['content'];
			$charset = !empty($params['charset'])?$params['charset']:'utf8';
			$head = $ini->contentType($content,$charset);
		break;
		case 'contentStyleType' : 
			$content = !isset($params['content'])?trigger_error("content: missing 'content' parameter"):$params['content'];
			$head = $ini->contentStyleType($content);
		break;
		case 'contentLanguage' :
			$content = !isset($params['content'])?trigger_error("content: missing 'content' parameter"):$params['content'];
			$head = $ini->contentLanguage($content);
		break;
		case 'revisitAfter' : 
			$int = !empty($params['int'])? $params['int'] : 3;
			$delay = !empty($params['delay']) ? $params['delay']: 'days';
			$head = $ini->revisitAfter($int,$delay);
		break;
		case 'keywords' :
			$content = !isset($params['content'])?trigger_error("content: missing 'content' parameter"):$params['content'];
			$head = $ini->keywords($content);
		break;
		case 'robots' :
			$content = !isset($params['content'])?trigger_error("content: missing 'content' parameter"):$params['content'];
			$head = $ini->robots($content);
		break;
		case 'googleSiteVerification' :
			$content = !isset($params['content'])?trigger_error("content: missing 'content' parameter"):$params['content'];
			$head = $ini->googleSiteVerification($content);
		break;
		case 'description' :
			$content = !isset($params['content'])?trigger_error("content: missing 'content' parameter"):$params['content'];
			$head = $ini->description($content);
		break;
	}
	return $head;
}