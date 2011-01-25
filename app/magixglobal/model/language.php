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
 * @category   MODEL 
 * @package    magixglobal
 * @copyright  MAGIX CMS Copyright (c) 2010 Gerits Aurelien, 
 * http://www.magix-cms.com, http://www.logiciel-referencement-professionnel.com http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    1.0
 * @author Gérits Aurélien <aurelien@web-solution-way.be> | <gerits.aurelien@gmail.com>
 * @name language
 *
 */
class magixglobal_model_language extends modele_db_language{
	public $getlang;
	static protected $reg_codelang = array('fr','en','nl','es','it','de','cn');
	function _construct(){
		$this->getlang = magixcjquery_filter_join::getCleanAlpha($_GET['strLangue'],3);
	}
	/**
	 * 
	 * Détection de la langue du navigateur
	 * @param $aLanguages
	 * @param $sDefault
	 */
	protected function browserSelectLang($aLanguages, $sDefault = 'fr') {
		if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$aBrowserLanguages = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
			foreach($aBrowserLanguages as $sBrowserLanguage) {
				$sLang = strtolower(substr($sBrowserLanguage,0,2));
				if(in_array($sLang, $aLanguages)) {
					return $sLang;
				}
			}
		}
		return $sDefault;
	}
	/**
	 * 
	 * Execution de la detection de la langue du navigateur
	 */
	protected function detect_browser_Lang(){
		return self::browserSelectLang(self::$reg_codelang, 'en');
	}
	/**
	 * 
	 * Selection de la langue dans la base de donnée
	 * @param $codelang
	 */
	protected function db_select_lang($codelang){
		foreach (parent::fetch_lang_exist($codelang) as $lang){
			return $lang['codelang'];
		}
	}
	/**
	 * 
	 * Execute la détection si la langue du navigateur correspond avec la langue dans la liste
	 */
	public function register_lang(){
		if(self::db_select_lang(self::detect_browser_Lang()) != null){
			return self::detect_browser_Lang();
		}
	}
	
	private function notify_lang(){
		if(self::register_lang() != $this->getlang){
			switch(self::register_lang()){
				case "fr":
					return "test fr";
				break;
				case "en":
					return "test en";
				break;
			}
		}elseif(self::register_lang() == null){
			switch($this->getlang){
				case "fr":
					return "test fr";
				break;
				case "en":
					return "test en";
				break;
			}
		}
		print_r(self::register_lang());
	}
}
class modele_db_language{
	protected function fetch_lang_exist($codelang){
	    $sql = 'SELECT l.idlang, l.codelang, l.desclang
	           FROM mc_lang AS l WHERE l.codelang = :codelang';
	    return magixglobal_model_db::layerDB()->select($sql,array(
	    	':codelang'=>$codelang
	    ));
	}
}