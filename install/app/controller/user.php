<?php
/*
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of MAGIX CMS.
# MAGIX CMS, The content management system optimized for users
# Copyright (C) 2008 - 2013 sc-box.com <support@magix-cms.com>
#
# OFFICIAL TEAM :
#
#   * Gerits Aurelien (Author - Developer) <aurelien@magix-cms.com> <contact@aurelien-gerits.be>
#
# Redistributions of files must retain the above copyright notice.
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

# DISCLAIMER

# Do not edit or add to this file if you wish to upgrade MAGIX CMS to newer
# versions in the future. If you wish to customize MAGIX CMS for your
# needs please refer to http://www.magix-cms.com for more information.
*/
/**
 * Author: Gerits Aurelien <aurelien[at]magix-cms[point]com>
 * Copyright: MAGIX CMS
 * Date: 25/02/13
 * Time: 22:18
 * License: Dual licensed under the MIT or GPL Version
 */
class app_controller_user extends app_db_user{
    /**
     * Constructor
     */
    function __construct(){
        if(magixcjquery_filter_request::isPost('pseudo')){
            $this->pseudo = magixcjquery_form_helpersforms::inputClean($_POST['pseudo']);
        }
        if(magixcjquery_filter_request::isPost('email')){
            $this->email = magixcjquery_form_helpersforms::inputClean($_POST['email']);
        }
        if(magixcjquery_filter_request::isPost('cryptpass')){
            $this->cryptpass = magixcjquery_form_helpersforms::inputClean(sha1($_POST['cryptpass']));
        }
        if(magixcjquery_filter_request::isGet('action')){
            $this->action = magixcjquery_form_helpersforms::inputClean($_GET['action']);
        }
    }

    /**
     * Insert un nouvel utilisateur
     * @param $create
     */
    private function insert_user(){
        if(isset($this->pseudo) AND isset($this->cryptpass)){
            parent::i_new_user(
                1,
                $this->pseudo,
                $this->email,
                $this->cryptpass,
                magixglobal_model_cryptrsa::uuid_generator()
            );
            app_model_smarty::getInstance()->display('user/request/success_add.phtml');
        }
    }
    /**
     *  @access public
     */
    public function run(){
        if(isset($this->action)){
            if($this->action === 'add'){
                $this->insert_user();
            }
        }else{
            app_model_smarty::getInstance()->display('user/index.phtml');
        }
    }
}
?>