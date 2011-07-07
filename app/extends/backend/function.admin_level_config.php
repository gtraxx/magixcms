<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of Magix CMS.
# Magix CMS, a CMS optimized for SEO
# Copyright (C) 2011 - 2012  Gerits Aurelien <aurelien@magix-cms.com>
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
 * @copyright  MAGIX CMS Copyright (c) 2010 - 2011 Gerits Aurelien, 
 * @link http://www.magix-cms.com,http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    1.0
 * @author Gérits Aurélien <aurelien@magix-cms.com>
 * Type:     function
 * Name:     admin_level_config
 * Date:     29/05/2011
 * Purpose:  
 * Examples: {admin_level_config config_param=['module'=>'cms']}
 * Output:   
 * @param $params
 * @param $template
 * @return void
 */
function smarty_function_admin_level_config($params, $template){
	if (!isset($params['config_param'])) {
	 	trigger_error("config_param: missing 'config_param' parameter");
		return;
	}
	if(is_array($params['config_param'])){
		$tabs = $params['config_param'];
	}
	$widget = '';
	if(class_exists('backend_model_setting',true)){
		$setting = new backend_model_setting();
		$attr_name = $setting->tabs_load_config($tabs['module']);
		$widget = $attr_name['status'];
	}else{
		trigger_error("model_setting is not exist", E_USER_WARNING);
	}
	return $widget;
}