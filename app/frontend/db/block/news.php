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
 * @category   DB CLass 
 * @package    Magix CMS
 * @copyright  MAGIX CMS Copyright (c) 2011 -2012 Gerits Aurelien, 
 * http://www.magix-cms.com, http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    1.0
 * @author Gérits Aurélien <aurelien@web-solution-way.be> | <gerits.aurelien@gmail.com>
 *
 */
class frontend_db_block_news{
	/**
	 * Affiche les données métas d'une page CMS
	 * @param $getpurl
	 */
	public function s_lastnews_plugins($iso){
		$sql = 'SELECT n.n_title,n.n_content,n.n_uri,n.idlang,n.date_register,n.date_publish,n.keynews,lang.iso
				FROM mc_news as n
				JOIN mc_lang AS lang ON(n.idlang = lang.idlang)
				WHERE n.published = 1 AND lang.iso = :iso ORDER BY n.idnews DESC LIMIT 1';
		return magixglobal_model_db::layerDB()->selectOne($sql,array(':iso' =>$iso));
	}
}