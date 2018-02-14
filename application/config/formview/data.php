<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年10月5日
 * @author Administrator
 * @version
 * @des
 */

$config['data/abnormity_model/insert_abnormity'] = array(
    'name' => 'a_name',
    'print_list' => 'a_print_list',
    'scan' => 'a_scan'
);
$config['data/abnormity_model/update_abnormity'] = array(
    'name' => 'a_name',
    'print_list' => 'a_print_list',
    'scan' => 'a_scan'
);

$config['data/area_model/insert'] = array(
    'province' => 'a_province',
    'city' => 'a_city',
    'county' => 'a_county'
);

$config['data/area_model/update'] = array(
    'province' => 'a_province',
    'city' => 'a_city',
    'county' => 'a_county'
);

$config['data/board_class_model/insert_board_class'] = array(
    'name' => 'bc_name'
);

$config['data/board_class_model/update_board_class'] = array(
    'name' => 'bc_name'
);

$config['data/board_color_model/insert_board_color'] = array(
    'name' => 'bc_name'
);

$config['data/board_color_model/update_board_color'] = array(
    'name' => 'bc_name'
);

$config['data/board_nature_model/insert_board_nature'] = array(
    'name' => 'bn_name'
);

$config['data/board_nature_model/update_board_nature'] = array(
    'name' => 'bn_name'
);

$config['data/board_thick_model/insert_board_thick'] = array(
    'name' => 'bt_name'
);

$config['data/board_thick_model/update_board_thick'] = array(
    'name' => 'bt_name'
);

$config['data/classify_model/insert'] = array(
    'name' => 'c_name',
    'class' => 'c_class',
    'parent' => 'c_parent',
    'flag' => 'c_flag',
    'print_list' => 'c_print_list',
    'label' => 'c_label',
    'optimize' => 'c_optimize',
    'plate_name' => 'c_plate_name',
    'width_min' => 'c_width_min',
    'width_max' => 'c_width_max',
    'length_min' => 'c_length_min',
    'length_max' => 'c_length_max',
    'thick' => 'c_thick',
    'edge' => 'c_edge',
    'slot' => 'c_slot',
    'remark' => 'c_remark',
    'status' => 'c_status',
    'process' => 'c_process'
);

$config['data/classify_model/update'] = array(
    'name' => 'c_name',
    'class' => 'c_class',
    'parent' => 'c_parent',
    'flag' => 'c_flag',
    'print_list' => 'c_print_list',
    'label' => 'c_label',
    'optimize' => 'c_optimize',
    'plate_name' => 'c_plate_name',
    'width_min' => 'c_width_min',
    'width_max' => 'c_width_max',
    'length_min' => 'c_length_min',
    'length_max' => 'c_length_max',
    'thick' => 'c_thick',
    'edge' => 'c_edge',
    'slot' => 'c_slot',
    'remark' => 'c_remark',
    'status' => 'c_status',
    'process' => 'c_process'
);

$config['data/face_model/insert_face'] = array(
    'wardrobe_punch' => 'f_wardrobe_punch',
    'wardrobe_slot' => 'f_wardrobe_slot',
    'flag' => 'f_flag'
);

$config['data/face_model/update_face'] = array(
    'wardrobe_punch' => 'f_wardrobe_punch',
    'wardrobe_slot' => 'f_wardrobe_slot',
    'flag' => 'f_flag'
);

$config['data/logistics_model/insert'] = array(
    'name' => 'l_name',
    'aid' => 'l_area_id',
    'address' => 'l_address',
    'phone' => 'l_phone',
    'vip' => 'l_vip'
);

$config['data/logistics_model/update'] = array(
    'name' => 'l_name',
    'aid' => 'l_area_id',
    'address' => 'l_address',
    'phone' => 'l_phone',
    'vip' => 'l_vip'
);

$config['data/order_type_model/insert'] = array(
    'name' => 'ot_name',
    'code' => 'ot_code'
);

$config['data/order_type_model/update'] = array(
    'name' => 'ot_name',
    'code' => 'ot_code'
);

$config['data/out_method_model/insert'] = array(
    'name' => 'om_name'
);

$config['data/out_method_model/update'] = array(
    'name' => 'om_name'
);

$config['data/task_level_model/insert'] = array(
    'name' => 'tl_name',
    'icon' => 'tl_icon',
    'remark' => 'tl_remark'
);

$config['data/task_level_model/update'] = array(
    'name' => 'tl_name',
    'icon' => 'tl_icon',
    'remark' => 'tl_remark'
);

$config['data/train_model/insert_train'] = array(
    'name' => 't_name'
);
$config['data/train_model/update_train'] = array(
    'name' => 't_name'
);

$config['data/truck_model/insert_truck'] = array(
    'name' => 't_name'
);
$config['data/truck_model/update_truck'] = array(
    'name' => 't_name'
);

$config['data/wardrobe_board_model/insert_wardrobe_board'] = array(
    'name' => 'wb_name'
);

$config['data/wardrobe_board_model/update_wardrobe_board'] = array(
    'name' => 'wb_name'
);

$config['data/wardrobe_edge_model/insert_wardrobe_edge'] = array(
    'name' => 'we_name',
    'ups' => 'we_up',
    'downs' => 'we_down',
    'lefts' => 'we_left',
    'rights' => 'we_right'
);

$config['data/wardrobe_edge_model/update_wardrobe_edge'] = array(
    'name' => 'we_name',
    'ups' => 'we_up',
    'downs' => 'we_down',
    'lefts' => 'we_left',
    'rights' => 'we_right'
);

$config['data/wardrobe_slot_model/insert_wardrobe_slot'] = array(
    'name' => 'ws_name'
);

$config['data/wardrobe_slot_model/update_wardrobe_slot'] = array(
    'name' => 'ws_name'
);

$config['data/wardrobe_punch_model/insert_wardrobe_punch'] = array(
    'name' => 'wp_name'
);

$config['data/wardrobe_punch_model/update_wardrobe_punch'] = array(
    'name' => 'wp_name'
);

$config['data/workflow_model/insert'] = array(
    'no' => 'w_no',
    'type' => 'w_type',
    'name' => 'w_name',
    'name_en' => 'w_name_en',
    'file' => 'w_file'
);

$config['data/workflow_model/update'] = array(
    'no' => 'w_no',
    'type' => 'w_type',
    'name' => 'w_name',
    'name_en' => 'w_name_en',
    'file' => 'w_file'
);

$config['data/workflow_msg_model/insert'] = array(
    'model' => 'wm_model',
    'source_id' => 'wm_source_id',
    'creator' => 'wm_creator',
    'create_datetime' => 'wm_create_datetime',
    'msg' => 'wm_msg',
    'status' => 'wm_status'
);

$config['data/workflow_msg_model/insert_batch'] = array(
    'model' => 'wm_model',
    'source_id' => 'wm_source_id',
    'creator' => 'wm_creator',
    'create_datetime' => 'wm_create_datetime',
    'msg' => 'wm_msg',
    'status' => 'wm_status'
);