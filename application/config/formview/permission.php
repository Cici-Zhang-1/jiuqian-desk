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
    'label' => 'c_label',
    'url' => 'c_url',
    'mid' => 'c_menu_id',
    'card_type' => 'c_card_type',
    'card_setting' => 'c_card_setting'
);
$config['permission/card_model/update'] = array(
    'name' => 'c_name',
    'label' => 'c_label',
    'url' => 'c_url',
    'mid' => 'c_menu_id',
    'card_type' => 'c_card_type',
    'card_setting' => 'c_card_setting'
);

$config['permission/element_model/insert'] = array(
    'name' => 'e_name',
    'cid' => 'e_card_id',
    'classes' => 'e_classes',
    'label' => 'e_label',
    'checked' => 'e_checked',
    'displayorder' => 'e_displayorder',
    'dv' => 'e_dv'
);
$config['permission/element_model/update'] = array(
    'name' => 'e_name',
    'cid' => 'e_card_id',
    'classes' => 'e_classes',
    'label' => 'e_label',
    'checked' => 'e_checked',
    'displayorder' => 'e_displayorder',
    'dv' => 'e_dv'
);

$config['permission/form_model/insert'] = array(
    'name' => 'f_name',
    'label' => 'f_label',
    'form_type' => 'f_form_type',
    'url' => 'f_url',
    'dv' => 'f_dv',
    'placeholder' => 'f_placeholder',
    'classes' => 'f_classes',
    'readonly' => 'f_readonly',
    'required' => 'f_required',
    'multiple' => 'f_multiple',
    'max' => 'f_max',
    'min' => 'f_min',
    'maxlength' => 'f_maxlength',
    'pattern' => 'f_pattern',
    'ide' => 'f_ide',
    'func_id' => 'f_func_id'
);

$config['permission/form_model/update'] = array(
    'name' => 'f_name',
    'label' => 'f_label',
    'form_type' => 'f_form_type',
    'url' => 'f_url',
    'dv' => 'f_dv',
    'placeholder' => 'f_placeholder',
    'classes' => 'f_classes',
    'readonly' => 'f_readonly',
    'required' => 'f_required',
    'multiple' => 'f_multiple',
    'max' => 'f_max',
    'min' => 'f_min',
    'maxlength' => 'f_maxlength',
    'pattern' => 'f_pattern',
    'ide' => 'f_ide',
    'func_id' => 'f_func_id'
);

$config['permission/func_model/insert'] = array(
    'name' => 'f_name',
    'label' => 'f_label',
    'mid' => 'f_menu_id',
    'url' => 'f_url',
    'displayorder' => 'f_displayorder',
    'img' => 'f_img',
    'group_no' => 'f_group_no',
    'toggle' => 'f_toggle',
    'target' => 'f_target',
    'tag' => 'f_tag',
    'multiple' => 'f_multiple',
    'source' => 'f_source',
    'modal_type' => 'f_modal_type'
);
$config['permission/func_model/update'] = array(
    'name' => 'f_name',
    'label' => 'f_label',
    'mid' => 'f_menu_id',
    'url' => 'f_url',
    'displayorder' => 'f_displayorder',
    'img' => 'f_img',
    'group_no' => 'f_group_no',
    'toggle' => 'f_toggle',
    'target' => 'f_target',
    'tag' => 'f_tag',
    'multiple' => 'f_multiple',
    'source' => 'f_source',
    'modal_type' => 'f_modal_type'
);

$config['permission/menu_model/insert'] = array(
    'name' => 'm_name',
    'label' => 'm_label',
    'class' => 'm_class',
    'parent' => 'm_parent',
    'url' => 'm_url',
    'displayorder' => 'm_displayorder',
    'img' => 'm_img',
    'page_type' => 'm_page_type',
    'mobile' => 'm_mobile',
    'invisible' => 'm_invisible'
);

$config['permission/menu_model/update'] = array(
    'name' => 'm_name',
    'label' => 'm_label',
    'class' => 'm_class',
    'parent' => 'm_parent',
    'url' => 'm_url',
    'displayorder' => 'm_displayorder',
    'img' => 'm_img',
    'page_type' => 'm_page_type',
    'mobile' => 'm_mobile',
    'invisible' => 'm_invisible'
);

$config['permission/page_form_model/insert'] = array(
    'name' => 'pf_name',
    'mid' => 'pf_menu_id',
    'label' => 'pf_label',
    'url' => 'pf_url',
    'form_type' => 'pf_form_type',
    'dv' => 'pf_dv',
    'placeholder' => 'pf_placeholder',
    'classes' => 'pf_classes',
    'readonly' => 'pf_readonly',
    'required' => 'pf_required',
    'multiple' => 'pf_multiple',
    'max' => 'pf_max',
    'min' => 'pf_min',
    'maxlength' => 'pf_maxlength',
    'pattern' => 'pf_pattern',
    'ide' => 'pf_ide'
);
$config['permission/page_form_model/update'] = array(
    'name' => 'pf_name',
    'mid' => 'pf_menu_id',
    'label' => 'pf_label',
    'url' => 'pf_url',
    'form_type' => 'pf_form_type',
    'dv' => 'pf_dv',
    'placeholder' => 'pf_placeholder',
    'classes' => 'pf_classes',
    'readonly' => 'pf_readonly',
    'required' => 'pf_required',
    'multiple' => 'pf_multiple',
    'max' => 'pf_max',
    'min' => 'pf_min',
    'maxlength' => 'pf_maxlength',
    'pattern' => 'pf_pattern',
    'ide' => 'pf_ide'
);

$config['permission/page_search_model/insert'] = array(
    'name' => 'ps_name',
    'mid' => 'ps_menu_id',
    'label' => 'ps_label',
    'url' => 'ps_url',
    'form_type' => 'ps_form_type',
    'type' => 'ps_type',
    'dv' => 'ps_dv',
    'placeholder' => 'ps_placeholder',
    'classes' => 'ps_classes',
    'readonly' => 'ps_readonly',
    'required' => 'ps_required',
    'multiple' => 'ps_multiple',
    'max' => 'ps_max',
    'min' => 'ps_min',
    'maxlength' => 'ps_maxlength',
    'pattern' => 'ps_pattern',
    'ide' => 'ps_ide'
);
$config['permission/page_search_model/update'] = array(
    'name' => 'ps_name',
    'mid' => 'ps_menu_id',
    'label' => 'ps_label',
    'url' => 'ps_url',
    'form_type' => 'ps_form_type',
    'type' => 'ps_type',
    'dv' => 'ps_dv',
    'placeholder' => 'ps_placeholder',
    'classes' => 'ps_classes',
    'readonly' => 'ps_readonly',
    'required' => 'ps_required',
    'multiple' => 'ps_multiple',
    'max' => 'ps_max',
    'min' => 'ps_min',
    'maxlength' => 'ps_maxlength',
    'pattern' => 'ps_pattern',
    'ide' => 'ps_ide'
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

$config['permission/role_page_form_model/insert'] = array(
    'rid' => 'rpf_role_id',
    'pfid' => 'rpf_page_form_id',
    'creator' => 'rpf_creator',
    'create_datetime' => 'rpf_create_datetime'
);
$config['permission/role_page_form_model/insert_batch'] = array(
    'rid' => 'rpf_role_id',
    'pfid' => 'rpf_page_form_id',
    'creator' => 'rpf_creator',
    'create_datetime' => 'rpf_create_datetime'
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
