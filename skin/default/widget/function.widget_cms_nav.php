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
 * http://www.magix-cms.com,  http://www.magix-cjquery.com
 * @license    Dual licensed under the MIT or GPL Version 3 licenses.
 * @version    plugin version
 * @author Gérits Aurélien <aurelien@magix-cms.com> <aurelien@magix-dev.be>
 *
 */
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */
/**
 * Smarty {widget_cms_nav} function plugin
 *
 * Type:     function
 * Name:     widget_cms_nav
 * Date:     22/09/2012
 * Update:   12/01/2012
 * Output:
 * @author   Sire Sam (http://www.sire-sam.be)
 * @author   Gerits Aurélien (http://www.magix-dev.be)
 * @version  1.1
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_widget_cms_nav($params, $template){

    // *** Catch location var
    $id_current = isset($_GET['getidpage']) ? magixcjquery_form_helpersforms::inputNumeric($_GET['getidpage']) : null;
    $id_current_p = isset($_GET['getidpage_p']) ? magixcjquery_form_helpersforms::inputNumeric($_GET['getidpage_p']) : null;
    $lang =  frontend_model_template::current_Language();

    /**
     * @TODO revoir en profondeur les méthodes de ce widget pour être en cohérence avec les autres méthodes (voir: widget_cms_display)
     */
    // ***Hierarchy level Display var
    $data_sort_id = null;
    $data_sort_type = null;
    $sub_data_display = 1;                 // [0 => don't display, 1 => display]
    $data_display = 1;                     // [0 => don't display, 1 => display]
    if (isset($params['hierarchy']) ){
            $hierarchy = $params['hierarchy'];
            if (isset($hierarchy['select'])){
                if( $hierarchy['select'] == 'current'){
                    if ($_SERVER['SCRIPT_NAME'] == '/cms.php'){
                        $data_sort_id = $id_current_p != null ? $id_current_p : $id_current;
                    }
                } elseif( is_array($hierarchy['select'])){
                    if (array_key_exists($lang,$hierarchy['select'])){
                        $data_sort_id = $hierarchy['select'][$lang];
                    }
                }
            }elseif(isset($hierarchy['exclude'])){
                if( is_array($hierarchy['exclude'])){
                    if (array_key_exists($lang,$hierarchy['exclude'])){
                        $data_sort_id = $hierarchy['exclude'][$lang];
                        $data_sort_type = 'exclude';
                    }
                }
            }
            if (isset($hierarchy['level'])){
                if ( $hierarchy['level'] == 'parent') {  $sub_data_display = 0;}
                if ( $hierarchy['level'] == 'child')  {  $data_display = 0;}
            }
    }

        // ****SQL DATA
    $data_sort_id = (is_array($data_sort_id)) ? implode(',',$data_sort_id) : magixcjquery_form_helpersforms::inputNumeric($data_sort_id);
    $data = frontend_db_block_cms::s_parent_p($lang,$data_sort_id,$data_sort_type);


    if($data != null){
            // ***HTML attributs var
        if ($params['htmlAttribut']){
            $htmlAttr = $params['htmlAttribut'];

            $id_container       =       isset($htmlAttr['id_container'])       ? ' id="'.$htmlAttr['id_container'].'"'      : null;
            $class_container    =       isset($htmlAttr['class_container'])    ? ' class="'.$htmlAttr['class_container'].'"'   : null;
            $class_current      =       isset($htmlAttr['class_current'])      ? $htmlAttr['class_current'] : 'current';
        }
            // ***HTML injection var
        $title = isset($params['title']) ? $params['title'] : null;

            // ***tanslation var
        $tr_show_page = ucfirst(frontend_model_template::getConfigVars('show_page'));

        /*** FORMATTING ***/
        /**********************/
        $items = null;
        foreach($data as $row){

            /** SUB-DATA (child pages)**/
            $sub_data = ($sub_data_display != 0) ? frontend_db_block_cms::s_child_page($row['idpage']) : null;
            $sub_items = null;

            if ($sub_data != null) {
                $list_items = null;
                foreach($sub_data as $sub_row){
                    $current_item = ($sub_row['idpage'] == $id_current) ? $class_current : null;
                    $uri_item = magixglobal_model_rewrite::filter_cms_url($sub_row['iso'], $sub_row['idcat_p'], $row['uri_page'], $sub_row['idpage'], $sub_row['uri_page'],true);
                    $name_item = $sub_row['title_page'];
                    $class_item = ($current_item != null) ? ' class="'.$current_item.'"' : null;

                    $item =  '<li'.$class_item.'>';
                        $item .= '<a href="'.$uri_item.'" title="'.$tr_show_page .': '.$name_item.'">';
                            $item .= $name_item;
                        $item .= '</a>';
                    $item .= '</li>';
                    $list_items .= $item;
                }
                $sub_items = $list_items;
            }

            /** DATA (parent pages)**/
            $current_item = ($row['idpage'] == $id_current OR $row['idpage'] == $id_current_p) ? $class_current : null;
            $uri_item = magixglobal_model_rewrite::filter_cms_url($row['iso'], NULL, NULL, $row['idpage'], $row['uri_page'],true);
            $name_item = $row['title_page'];
            $class_item = ($current_item != null) ? ' class="'.$current_item.'"' : null;

            $item =  '<li'.$class_item.'>';
                $item .= '<a href="'.$uri_item.'" title="'.$tr_show_page .': '.$name_item.'">';
                    $item .= $name_item;
                $item .= '</a>';
                $item .= ($sub_items != null) ? '<ul class="subnav-list">'.$sub_items.'</ul>' : '';
            $item .= '</li>';
            $items .= ($data_display != 0) ? $item : $sub_items ;
        }

        if ($items != null) {
            $output  = isset($title) ? $title : null;
            $output .= '<ul'.$id_container.$class_container.'>';
            $output .= isset($params['htmlPrepend']) ? $params['htmlPrepend'] : null;
            $output .=  $items;
            $output .= isset($params['htmlAppend']) ? $params['htmlAppend'] : null;
            $output .= '</ul>';
        }else {
            $output = null;
        }


    }else{
        $output = null;
    }
	return $output;
}