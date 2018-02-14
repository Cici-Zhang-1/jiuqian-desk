<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created for jiuqian-desk.
 * User: chuangchuangzhang
 * Date: 2018/2/12
 * Time: 11:05
 *
 * Desc:
 */
$config['priviledge/card_model/select'] = array(
    'c_id' => 'cid',
    'c_name' => 'name',
    'm_name' => 'menu',
);
$config['priviledge/card_model/select_by_mid'] = array(
    'c_id' => 'cid',
    'c_name' => 'name',
    'c_card_type' => 'card_type',
    'c_card_setting' => 'card_setting',
    'c_menu_id' => 'mid'
);

$config['priviledge/element_model/select'] = array(
    'e_id' => 'eid',
    'e_name' => 'name',
    'e_label' => 'label',
    'c_name' => 'card',
    'm_name' => 'menu',
);
$config['priviledge/element_model/select_by_cid'] = array(
    'e_id' => 'eid',
    'e_name' => 'name',
    'e_label' => 'label',
    'e_classes' => 'classes',
    'e_card_id' => 'cid'
);

$config['priviledge/form_model/select'] = array(
    'A.f_id' => 'fid',
    'A.f_name' => 'name',
    'B.f_name' => 'func',
    'm_name' => 'menu'
);
$config['priviledge/form_model/select_by_fid'] = array(
    'f_id' => 'fid',
    'f_name' => 'name',
    'f_func_id' => 'func_id'
);

$config['priviledge/func_model/select'] = array(
    'f_id' => 'fid',
    'f_name' => 'name',
    'm_name' => 'menu',
);

$config['priviledge/func_model/select_by_mid'] = array(
    'f_id' => 'fid',
    'f_name' => 'name',
    'f_url' => 'url',
    'f_displayorder' => 'displayorder',
    'f_img' => 'img',
    'f_group_no' => 'group_no',
    'f_toggle' => 'toggle',
    'f_target' => 'target',
    'f_multiple' => 'multiple',
    'f_tag' => 'tag',
    'f_menu_id' => 'mid'
);

$config['priviledge/menu_model/select_by_uid'] = array(
    'm_id' => 'id',
    'm_name' => 'name',
    'm_class' => 'class',
    'm_parent' => 'parent',
    'm_url' => 'url',
    'm_displayorder' => 'displayorder',
    'm_img' => 'img'
);
$config['priviledge/menu_model/select_menu'] = array(
    'm_id' => 'mid',
    'm_name' => 'name',
    'm_class' => 'class',
    'm_parent' => 'parent',
    'm_url' => 'url',
    'm_displayorder' => 'displayorder',
    'm_img' => 'img'
);

$config['priviledge/role_element_model/select_by_rid'] = array(
    're_element_id' => 'eid'
);
$config['priviledge/role_card_model/select_by_rid'] = array(
    'rc_card_id' => 'cid'
);
$config['priviledge/role_form_model/select_by_rid'] = array(
    'rf_form_id' => 'fid'
);
$config['priviledge/role_func_model/select_by_rid'] = array(
    'rf_func_id' => 'fid'
);
$config['priviledge/role_menu_model/select_by_rid'] = array(
    'rm_menu_id' => 'mid'
);

$config['priviledge/role_model/select'] = array(
    'r_id' => 'rid',
    'r_name' => 'name'
);

$config['priviledge/usergroup_model/select'] = array(
    'u_id' => 'uid',
    'u_name' => 'name',
    'u_class' => 'class',
    'u_parent' => 'parent'
);

$config['priviledge/usergroup_role_model/select'] = array(
    'ur_id' => 'id',
    'ur_usergroup_id' => 'usergroup_id',
    'u_name' => 'usergroup',
    'ur_role_id' => 'role_id',
    'r_name' => 'role'
);

$config['priviledge/usergroup_role_model/select_by_child'] = array(
    'r_id' => 'rid',
    'r_name' => 'name'
);

$config['priviledge/usergroup_role_model/select_by_uid'] = array(
    'ur_role_id' => 'rid'
);
