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
$config['permission/card_model/select'] = array(
    'c_id' => 'cid',
    'c_url' => 'url',
    'c_name' => 'name',
    'm_name' => 'menu',
);
$config['permission/card_model/select_allowed'] = array(
    'c_id' => 'cid',
    'c_name' => 'name'
);
$config['permission/card_model/select_by_mid'] = array(
    'c_id' => 'cid',
    'c_name' => 'name',
    'c_url' => 'url',
    'c_card_type' => 'card_type',
    'c_card_setting' => 'card_setting',
    'c_menu_id' => 'mid'
);

$config['permission/element_model/select'] = array(
    'e_id' => 'eid',
    'e_name' => 'name',
    'e_label' => 'label',
    'c_name' => 'card',
    'm_name' => 'menu',
);
$config['permission/element_model/select_allowed'] = array(
    'e_id' => 'eid',
    'e_name' => 'name',
    'c_name' => 'card'
);
$config['permission/element_model/select_by_card_url'] = array(
    'e_id' => 'eid',
    'e_name' => 'name',
    'c_name' => 'card'
);
$config['permission/element_model/select_by_cid'] = array(
    'e_id' => 'eid',
    'e_name' => 'name',
    'e_label' => 'label',
    'e_classes' => 'classes',
    'e_card_id' => 'cid'
);

$config['permission/form_model/select'] = array(
    'A.f_id' => 'fid',
    'A.f_name' => 'name',
    'B.f_name' => 'func',
    'm_name' => 'menu'
);
$config['permission/form_model/select_allowed'] = array(
    'A.f_id' => 'fid',
    'A.f_name' => 'name',
    'B.f_name' => 'func'
);
$config['permission/form_model/select_by_fid'] = array(
    'f_id' => 'fid',
    'f_name' => 'name',
    'f_func_id' => 'func_id'
);

$config['permission/func_model/select'] = array(
    'f_id' => 'fid',
    'f_name' => 'name',
    'm_name' => 'menu',
);
$config['permission/func_model/select_by_mid'] = array(
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
$config['permission/func_model/select_allowed'] = array(
    'f_id' => 'fid',
    'f_name' => 'name',
    'f_url' => 'url'
);
$config['permission/func_model/select_is_allowed_operation'] = array(
    'f_id' => 'fid'
);

$config['permission/menu_model/select_allowed_by_ugid'] = array(
    'm_id' => 'mid',
    'm_name' => 'name',
    'm_class' => 'class',
    'm_parent' => 'parent',
    'm_url' => 'url',
    'm_displayorder' => 'displayorder',
    'm_img' => 'img'
);

$config['permission/menu_model/select_by_uid'] = array(
    'm_id' => 'id',
    'm_name' => 'name',
    'm_class' => 'class',
    'm_parent' => 'parent',
    'm_url' => 'url',
    'm_displayorder' => 'displayorder',
    'm_img' => 'img'
);
$config['permission/menu_model/select_menu'] = array(
    'm_id' => 'mid',
    'm_name' => 'name',
    'm_class' => 'class',
    'm_parent' => 'parent',
    'm_url' => 'url',
    'm_displayorder' => 'displayorder',
    'm_img' => 'img'
);
$config['permission/menu_model/select_is_allowed_operation'] = array(
    'm_id' => 'mid'
);

$config['permission/page_search_model/select'] = array(
    'ps_id' => 'psid',
    'ps_name' => 'name',
    'ps_label' => 'label',
    'm_name' => 'menu'
);
$config['permission/page_search_model/select_allowed'] = array(
    'ps_id' => 'psid',
    'ps_name' => 'name',
    'ps_label' => 'label'
);
$config['permission/page_search_model/select_by_mid'] = array(
    'ps_id' => 'psid',
    'ps_name' => 'name',
    'ps_label' => 'label',
    'ps_menu_id' => 'mid'
);

$config['permission/role_element_model/select_by_rid'] = array(
    're_element_id' => 'eid'
);
$config['permission/role_card_model/select_by_rid'] = array(
    'rc_card_id' => 'cid'
);
$config['permission/role_form_model/select_by_rid'] = array(
    'rf_form_id' => 'fid'
);
$config['permission/role_func_model/select_by_rid'] = array(
    'rf_func_id' => 'fid'
);
$config['permission/role_menu_model/select_by_rid'] = array(
    'rm_menu_id' => 'mid'
);
$config['permission/role_page_search_model/select_by_rid'] = array(
    'rps_page_search_id' => 'psid'
);
$config['permission/role_visit_model/select_by_rid'] = array(
    'rv_visit_id' => 'vid'
);

$config['permission/role_model/select'] = array(
    'r_id' => 'rid',
    'r_name' => 'name'
);

$config['permission/usergroup_model/select'] = array(
    'u_id' => 'uid',
    'u_name' => 'name',
    'u_class' => 'class',
    'u_parent' => 'parent'
);

$config['permission/usergroup_role_model/select'] = array(
    'ur_id' => 'id',
    'ur_usergroup_id' => 'usergroup_id',
    'u_name' => 'usergroup',
    'ur_role_id' => 'role_id',
    'r_name' => 'role'
);

$config['permission/usergroup_role_model/select_by_child'] = array(
    'r_id' => 'rid',
    'r_name' => 'name'
);

$config['permission/usergroup_role_model/select_by_uid'] = array(
    'ur_role_id' => 'rid'
);

$config['permission/visit_model/select'] = array(
    'v_id' => 'vid',
    'v_controller' => 'controller',
    'v_name' => 'name',
    'v_url' => 'url'
);

$config['permission/visit_model/select_allowed_by_ugid'] = array(
    'v_id' => 'vid',
    'v_name' => 'name',
    'v_url' => 'url'
);
$config['permission/visit_model/select_is_allowed_operation'] = array(
    'v_id' => 'vid'
);
