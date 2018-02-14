<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年10月5日
 * @author Zhangcc
 * @version
 * @des
 */

$config['data/abnormity_model/select_abnormity'] = array(
    'a_id' => 'aid',
    'a_name' => 'name',
    'a_print_list' => 'print_list',
    'a_scan' => 'scan'
);

$config['data/area_model/select'] = array(
    'a_id' => 'aid',
    'a_province' => 'province',
    'a_city' => 'city',
    'a_county' => 'county',
    'concat(ifnull(a_province, ""), ifnull(a_city, ""), ifnull(a_county,""))' => 'area'
);

$config['data/board_class_model/select_board_class'] = array(
    'bc_id' => 'bcid',
    'bc_name' => 'name'
);

$config['data/board_color_model/select_board_color'] = array(
    'bc_id' => 'bcid',
    'bc_name' => 'name'
);

$config['data/board_nature_model/select_board_nature'] = array(
    'bn_id' => 'bnid',
    'bn_name' => 'name'
);

$config['data/board_thick_model/select_board_thick'] = array(
    'bt_id' => 'btid',
    'bt_name' => 'name'
);

$config['data/classify_model/select'] = array(
    'c_id' => 'cid',
    'c_class' => 'class',
    'c_parent' => 'parent',
    'c_flag' => 'flag',
    'c_name' => 'name',
    'c_print_list' => 'print_list',
    'c_label' => 'label',
    'c_optimize' => 'optimize',
    'c_plate_name' => 'plate_name',
    'c_width_min' => 'width_min',
	'c_width_max' => 'width_max',
	'c_length_min' => 'length_min',
	'c_length_max' => 'length_max',
    'c_thick' => 'thick',
    'c_edge' => 'edge',
    'c_slot' => 'slot',
    'c_remark' => 'remark',
    'c_status' => 'status',
    'c_process' => 'process'
);

$config['data/classify_model/select_parents'] = array(
	'c_id' => 'cid',
	'c_name' => 'name'
);

$config['data/classify_model/select_children'] = array(
    'c_id' => 'cid',
    'c_class' => 'class',
    'c_parent' => 'parent',
    'c_flag' => 'flag',
    'c_name' => 'name',
    'c_print_list' => 'print_list',
    'c_label' => 'label',
    'c_optimize' => 'optimize',
    'c_plate_name' => 'plate_name',
	'c_width_min' => 'width_min',
	'c_width_max' => 'width_max',
	'c_length_min' => 'length_min',
	'c_length_max' => 'length_max',
    'c_thick' => 'thick',
    'c_edge' => 'edge',
    'c_slot' => 'slot',
    'c_remark' => 'remark',
    'c_process' => 'process'
);

$config['data/face_model/select_face'] = array(
	'f_id' => 'fid',
	'f_wardrobe_punch' => 'wardrobe_punch',
	'f_wardrobe_slot' => 'wardrobe_slot',
	'f_flag' => 'flag'
);
$config['data/classify_model/select_print_list'] = array(
    'c_id' => 'cid',
    'c_name' => 'name'
);

$config['data/classify_model/select_label'] = array(
    'c_id' => 'cid',
    'c_name' => 'name'
);

$config['data/logistics_model/select'] = array(
    'l_id' => 'lid',
    'l_name' => 'name',
    'a_id' => 'aid',
    'l_address' => 'address',
    'l_phone' => 'phone',
    'l_vip' => 'vip',
	'concat(ifnull(a_province, ""), ifnull(a_city, ""), ifnull(a_county, ""))' => 'area',
);

$config['data/order_type_model/select'] = array(
    'ot_id' => 'otid',
    'ot_name' => 'name',
    'ot_code' => 'code'
);

$config['data/out_method_model/select'] = array(
    'om_id' => 'omid',
    'om_name' => 'name'
);

$config['data/task_level_model/select'] = array(
    'tl_id' => 'tlid',
    'tl_name' => 'name',
    'tl_icon' => 'icon',
    'tl_remark' => 'remark'
);

$config['data/truck_model/select_truck'] = array(
    't_id' => 'tid',
    't_name' => 'name'
);
$config['data/train_model/select_train'] = array(
    't_id' => 'tid',
    't_name' => 'name'
);

$config['data/wardrobe_board_model/select_wardrobe_board'] = array(
    'wb_id' => 'wbid',
    'wb_name' => 'name'
);

$config['data/wardrobe_edge_model/select_wardrobe_edge'] = array(
    'we_id' => 'weid',
    'we_name' => 'name',
    'we_up' => 'ups',
    'we_down' => 'downs',
    'we_left' => 'lefts',
    'we_right' => 'rights'
);

$config['data/wardrobe_edge_model/select_wardrobe_edge_by_name'] = array(
	'we_up' => 'ups',
	'we_down' => 'downs',
	'we_left' => 'lefts',
	'we_right' => 'rights'
);

$config['data/wardrobe_slot_model/select_wardrobe_slot'] = array(
    'ws_id' => 'wsid',
    'ws_name' => 'name'
);

$config['data/wardrobe_punch_model/select_wardrobe_punch'] = array(
	'wp_id' => 'wpid',
	'wp_name' => 'name'
);

$config['data/workflow_model/select'] = array(
    'w_no' => 'no',
    'w_type' => 'type',
    'w_id' => 'wid',
    'w_name' => 'name',
    'w_name_en' => 'name_en',
    'w_file' => 'file'
);

$config['data/workflow_msg_model/select_by_oid'] = array(
    'wm_id' => 'wmid',
    'wm_model' => 'model',
    'u_truename' => 'creator',
    'wm_create_datetime' => 'create_datetime',
    'wm_msg' => 'msg',
    'o_num' => 'target'
);

$config['data/workflow_msg_model/select_by_opids'] = array(
    'wm_id' => 'wmid', 
    'wm_model' => 'model', 
    'u_truename' => 'creator', 
    'wm_create_datetime' => 'create_datetime', 
    'wm_msg' => 'msg', 
    'op_num' => 'target'
);

$config['data/workflow_msg_model/select_by_opcids'] = array(
    'wm_id' => 'wmid',
    'wm_model' => 'model',
    'u_truename' => 'creator',
    'wm_create_datetime' => 'create_datetime',
    'wm_msg' => 'msg',
    'op_num' => 'target'
);