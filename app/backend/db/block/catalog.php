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
 * @category   DB block
 * @package    backend
 * @copyright  MAGIX CMS Copyright (c) 2010 Gerits Aurelien, 
 * http://www.magix-cms.com, http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @id $Id: cms.php 379 2011-07-06 15:00:29Z aurelien $
 * @version  $Rev: 379 $
 * @author Gérits Aurélien <aurelien@magix-cms.com> $Author: aurelien $
 * @name cms
 *
 */
class backend_db_block_catalog{
	//CHART
    public static function chart_count_catalog(){
		$sql = 'SELECT count( catalog.idcatalog ) AS countcatalog, lang.iso, lang.language
		FROM mc_catalog AS catalog
		LEFT JOIN mc_lang AS lang ON ( catalog.idlang = lang.idlang )
		GROUP BY catalog.idlang';
		return magixglobal_model_db::layerDB()->select($sql);
    }
	public static function chart_count_category(){
		$sql = 'SELECT count( cat.idclc ) AS countcatalog_cat, lang.iso, lang.language
		FROM mc_catalog_c AS cat
		LEFT JOIN mc_lang AS lang ON ( cat.idlang = lang.idlang )
		GROUP BY cat.idlang';
		return magixglobal_model_db::layerDB()->select($sql);
    }
	public static function chart_count_subcategory(){
		$sql = 'SELECT count( s.idcls ) AS countcatalog_subcat, lang.iso, lang.language
		FROM mc_catalog_s AS s
		JOIN mc_catalog_c AS c ON ( c.idclc = s.idclc )
		LEFT JOIN mc_lang AS lang ON ( c.idlang = lang.idlang )
		GROUP BY c.idlang';
		return magixglobal_model_db::layerDB()->select($sql);
    }
}