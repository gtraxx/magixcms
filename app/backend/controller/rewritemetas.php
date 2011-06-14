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
 * @category   Controller 
 * @package    backend
 * @copyright  MAGIX CMS Copyright (c) 2010 Gerits Aurelien, 
 * http://www.magix-cms.com, http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    1.2
 * @author Gérits Aurélien <aurelien@magix-cms.com>
 * @name rewritemetas
 *
 */
class backend_controller_rewritemetas extends backend_db_rewritemetas{
	/**
	 * 
	 * @var intéger
	 */
	public $idmetas;
	/**
	 * 
	 * @var intéger
	 */
	public $idlang;
	/**
	 * Identifiant de la configuration
	 * @var integer
	 */
	public $attribute;
	/**
	 * Phrase pour la réécriture des métas
	 * @var string
	 */
	public $strrewrite;
	/**
	 * Niveau de la réécriture des métas
	 * @var integer
	 */
	public $level;
	/**
	 * Edition d'une réécriture des métas
	 * @var integer
	 */
	public $edit;
	/**
	 * Supprime une réécriture via l'identifiant
	 * @var drmetas
	 */
	public $drmetas;
	public function __construct(){
		if(magixcjquery_filter_request::isPost('idlang')){
			$this->idlang = magixcjquery_filter_isVar::isPostNumeric($_POST['idlang']);
		}
		if(magixcjquery_filter_request::isPost('attribute')){
			$this->attribute = magixcjquery_form_helpersforms::inputClean($_POST['attribute']);
		}
		if(magixcjquery_filter_request::isPost('idmetas')){
			$this->idmetas = magixcjquery_filter_isVar::isPostNumeric($_POST['idmetas']);
		}
		if(magixcjquery_filter_request::isPost('strrewrite')){
			$this->strrewrite = magixcjquery_form_helpersforms::inputClean($_POST['strrewrite']);
		}
		if(magixcjquery_filter_request::isPost('level')){
			$this->level = magixcjquery_filter_isVar::isPostNumeric($_POST['level']);
		}
		if(magixcjquery_filter_request::isGet('edit')){
			$this->edit = magixcjquery_filter_isVar::isPostNumeric($_GET['edit']);
		}
		if(magixcjquery_filter_request::isGet('drmetas')){
			$this->drmetas = magixcjquery_filter_isVar::isPostNumeric($_GET['drmetas']);
		}
	}
	/**
	 * Affiche la réécriture des métas trié par langue
	 * @access private
	 */
	private function json_list_metas(){
		if(parent::s_rewrite_meta() != null){
			foreach (parent::s_rewrite_meta() as $s){
				$title[]= '{"idrewrite":'.json_encode($s['idrewrite']).',"attribute":'.json_encode($s['attribute']).
				',"idmetas":'.json_encode($s['idmetas']).',"strrewrite":'.json_encode($s['strrewrite']).
				',"level":'.json_encode($s['level']).',"codelang":'.json_encode($s['codelang']).'}';
			}
			print '['.implode(',',$title).']';
		}
	}
	/**
	 * insertion de la réécriture des métas
	 * @access private
	 */
	private function insertion_rewrite(){
		if(isset($this->strrewrite)){
			if(empty($this->attribute) OR empty($this->idmetas)){
				backend_controller_template::display('request/empty.phtml');
			}elseif(parent::s_rewrite_v_lang(
				$this->attribute,
				$this->idlang,
				$this->idmetas,
				$this->level) == null){
				parent::i_rewrite_metas(
					$this->attribute,
					$this->idlang,
					$this->strrewrite,
					$this->idmetas,
					$this->level
				);
				backend_controller_template::display('request/add_seo.phtml');
			}else{
				backend_controller_template::display('request/element-exist.phtml');
			}
		}
	}
	/**
	 * Mise à jour de la réécriture suivant l'identifiant
	 * @access private
	 */
	private function update_rewrite(){
		if(isset($this->edit)){
			if(isset($this->strrewrite)){
				if(empty($this->attribute) OR empty($this->idmetas)){
					backend_controller_template::display('request/empty.phtml');
				}else{
					parent::u_rewrite_metas($this->attribute,$this->idlang,$this->strrewrite,$this->idmetas,$this->level,$this->edit);
					backend_controller_template::display('config/request/update_seo.phtml');
				}
			}
		}
	}
	/**
	 * Supprime la réécriture suivant l'identifiant
	 * @access public
	 */
	private function d_rewrite(){
		if(isset($this->drmetas)){
			parent::d_rewrite_metas($this->drmetas);
		}
	}
	/**
	 * Charge les données dans le formulaire d'édition
	 * @access private
	 */
	private function load_rewrite_for_edit(){
		if(isset($this->edit)){
			$load = parent::s_rewrite_for_edit($this->edit);
			backend_controller_template::assign('strrewrite',$load['strrewrite']);
			backend_controller_template::assign('idlang',$load['idlang']);
			backend_controller_template::assign('codelang',$load['codelang']);
			backend_controller_template::assign('attribute',$load['attribute']);
			backend_controller_template::assign('level',$load['level']);
			backend_controller_template::assign('idmetas',$load['idmetas']);
		}
	}
	/**
	 * Affiche le fomulaire de modification ainsi que la liste des réécritures disponible
	 * @access public
	 */
	private function display_seo_edit(){
		self::load_rewrite_for_edit();
		backend_controller_template::display('config/editseo.phtml');
	}
	/**
	 * Affiche le formulaire et une liste des réécritures disponible
	 * @access public
	 */
	private function display(){
		$this->insertion_rewrite();
		backend_controller_template::assign('selectlang',backend_model_blockDom::select_language());
		$iniModules = new backend_model_modules();
		backend_controller_template::assign('select_module', $iniModules->select_menu_module());
		backend_controller_template::display('config/seo.phtml');
	}
	/**
	 * 
	 * Execute la fonction run
	 */
	public function run(){
		$header= new magixglobal_model_header();
		if(magixcjquery_filter_request::isGet('add')){
			self::insertion_rewrite();
		}elseif(magixcjquery_filter_request::isGet('edit')){
			if(magixcjquery_filter_request::isGet('post')){
				self::update_rewrite();
			}else{
				self::display_seo_edit();
			}
		}elseif(magixcjquery_filter_request::isGet('load_metas')){
			$header->head_expires("Mon, 26 Jul 1997 05:00:00 GMT");
			$header->head_last_modified(gmdate( "D, d M Y H:i:s" ) . "GMT");
			$header->pragma();
			$header->cache_control("nocache");
			$header->getStatus('200');
			$header->json_header("UTF-8");
			self::json_list_metas();
		}elseif(magixcjquery_filter_request::isGet('drmetas')){
			self::d_rewrite();
		}else{
			self::display();
		}
	}
}