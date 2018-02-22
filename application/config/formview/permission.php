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
$config['permission/card_model/insert'] = array(
    'name' => 'c_name',
    'url' => 'c_url',
    'mid' => 'c_menu_id',
    'card_type' => 'c_card_type',
    'card_setting' => 'c_card_setting'
);
$config['permission/card_model/update'] = array(
    'name' => 'c_name',
    'url' => 'c_url',
    'mid' => 'c_menu_id',
    'card_type' => 'c_card_type',
    'card_setting' => 'c_card_setting'
);

$config['permission/element_model/insert'] = array(
    'name' => 'e_name',
    'cid' => 'e_card_id',
    'classes' => 'e_classes',
    'label' => 'e_label'
);
$config['permission/element_model/update'] = array(
    'name' => 'e_name',
    'cid' => 'e_card_id',
    'classes' => 'e_classes',
    'label' => 'e_label'
);

$config['permission/form_model/insert'] = array(
    'name' => 'f_name',
    'func_id' => 'f_func_id'
);

$config['permission/form_model/update'] = array(
    'name' => 'f_name',
    'func_id' => 'f_func_id'
);

$config['permission/func_model/insert'] = array(
    'name' => 'f_name',
    'mid' => 'f_menu_id',
    'url' => 'f_url',
    'displayorder' => 'f_displayorder',
    'img' => 'f_img',
    'group_no' => 'f_group_no',
    'toggle' => 'f_toggle',
    'target' => 'f_target',
    'tag' => 'f_tag',
    'multiple' => 'f_multiple'
);
$config['permission/func_model/update'] = array(
    'name' => 'f_name',
    'mid' => 'f_menu_id',
    'url' => 'f_url',
    'displayorder' => 'f_displayorder',
    'img' => 'f_img',
    'group_no' => 'f_group_no',
    'toggle' => 'f_toggle',
    'target' => 'f_target',
    'tag' => 'f_tag',
    'multiple' => 'f_multiple'
);

$config['permission/menu_model/insert'] = array(
    'name' => 'm_name',
    'class' => 'm_class',
    'parent' => 'm_parent',
    'url' => 'm_url',
    'displayorder' => 'm_displayorder',
    'img' => 'm_img'
);

$config['permission/menu_model/update'] = array(
    'name' => 'm_name',
    'class' => 'm_class',
    'parent' => 'm_parent',
    'url' => 'm_url',
    'displayorder' => 'm_displayorder',
    'img' => 'm_img'
);

$config['permission/page_search_model/insert'] = array(
    'name' => 'ps_name',
    'mid' => 'ps_menu_id',
    'label' => 'ps_label'
);
$config['permission/page_search_model/update'] = array(
    'name' => 'ps_name',
    'mid' => 'ps_menu_id',
    'label' => 'ps_label'
);

$config['permission/role_card_model/insert'] = array(
    'rid' => 'rc_role_id',
    'cid' => 'rc_card_id',
    'creator' => 'rc_creator',
    'create_datetime' => 'rc_create_datetime'
);

$config['permission/role_card_model/insert_batch'] = array(
    'rid' => 'rc_role_id',
    'cid' => 'rc_card_id',
    'creator' => 'rc_creator',
    'create_datetime' => 'rc_create_datetime'
);

$config['permission/role_element_model/insert'] = array(
    'rid' => 're_role_id',
    'eid' => 're_element_id',
    'creator' => 're_creator',
    'create_datetime' => 're_create_datetime'
);

$config['permission/role_element_model/insert_batch'] = array(
    'rid' => 're_role_id',
    'eid' => 're_element_id',
    'creator' => 're_creator',
    'create_datetime' => 're_create_datetime'
);

$config['permission/role_form_model/insert'] = array(
    'rid' => 'rf_role_id',
    'fid' => 'rf_form_id',
    'creator' => 'rf_creator',
    'create_datetime' => 'rf_create_datetime'
);

$config['permission/role_form_model/insert_batch'] = array(
    'rid' => 'rf_role_id',
    'fid' => 'rf_form_id',
    'creator' => 'rf_creator',
    'create_datetime' => 'rf_create_datetime'
);

$config['permission/role_func_model/insert'] = array(
    'rid' => 'rf_role_id',
    'fid' => 'rf_func_id',
    'creator' => 'rf_creator',
    'create_datetime' => 'rf_create_datetime'
);

$config['permission/role_func_model/insert_batch'] = array(
    'rid' => 'rf_role_id',
    'fid' => 'rf_func_id',
    'creator' => 'rf_creator',
    'create_datetime' => 'rf_create_datetime'
);

$config['permission/role_menu_model/insert'] = array(
    'role_id' => 'rm_role_id',
    'menu_id' => 'rm_menu_id'
);


$config['permission/role_menu_model/insert_batch'] = array(
    'rid' => 'rm_role_id',
    'mid' => 'rm_menu_id'
);

$config['permission/role_model/insert'] = array(
    'name' => 'r_name',
    'creator' => 'r_creator',
    'create_datetime' => 'r_create_datetime'
);

$config['permission/role_model/update'] = array(
    'name' => 'r_name'
);

$config['permission/role_page_search_model/insert'] = array(
    'rid' => 'rps_role_id',
    'psid' => 'rps_page_search_id',
    'creator' => 'rps_creator',
    'create_datetime' => 'rps_create_datetime'
);

$config['permission/role_page_search_model/insert_batch'] = array(
    'rid' => 'rps_role_id',
    'psid' => 'rps_page_search_id',
    'creator' => 'rps_creator',
    'create_datetime' => 'rps_create_datetime'
);

$config['permission/role_visit_model/insert'] = array(
    'rid' => 'rv_role_id',
    'vid' => 'rv_visit_id',
    'creator' => 'rv_creator',
    'create_datetime' => 'rv_create_datetime'
);

$config['permission/role_visit_model/insert_batch'] = array(
    'rid' => 'rv_role_id',
    'vid' => 'rv_visit_id',
    'creator' => 'rv_creator',
    'create_datetime' => 'rv_create_datetime'
);

$config['permission/usergroup_model/insert'] = array(
    'name' => 'u_name',
    'parent' => 'u_parent',
    'class' => 'u_class',
    'creator' => 'u_creator',
    'create_datetime' => 'u_create_datetime'
);
$config['permission/usergroup_model/update'] = array(
    'name' => 'u_name',
    'parent' => 'u_parent',
    'class' => 'u_class'
);

$config['permission/usergroup_role_model/insert'] = array(
    'uid' => 'ur_usergroup_id',
    'rid' => 'ur_role_id'
);

$config['permission/usergroup_role_model/insert_batch'] = array(
    'uid' => 'ur_usergroup_id',
    'rid' => 'ur_role_id'
);

$config['permission/usergroup_role_model/update'] = array(
    'usergroup_id' => 'ur_usergroup_id',
    'role_id' => 'ur_role_id'
);

$config['permission/visit_model/insert'] = array(
    'controller' => 'v_controller',
    'url' => 'v_url',
    'name' => 'v_name'
);

$config['permission/visit_model/update'] = array(
    'controller' => 'v_controller',
    'url' => 'v_url',
    'name' => 'v_name'
);
