<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年10月24日
 * @author Zhangcc
 * @version
 * @des
 */

$config['order/order_model/insert_order'] = array(
    'dealer_id' => 'o_dealer_id',
    'dealer' => 'o_dealer',
    'checker' => 'o_checker',
    'checker_phone' => 'o_checker_phone',
    'payterms' => 'o_payterms',
    'payer' => 'o_payer',
    'payer_phone' => 'o_payer_phone',
    'logistics' => 'o_logistics',
    'out_method' => 'o_out_method',
    'delivery_area' => 'o_delivery_area',
    'delivery_address' => 'o_delivery_address',
    'delivery_linker' => 'o_delivery_linker',
    'delivery_phone' => 'o_delivery_phone',
    'owner' => 'o_owner',
    'remark' => 'o_remark',
    'dealer_remark' => 'o_dealer_remark',
    'request_outdate' => 'o_request_outdate',
    'creator' => 'o_creator',
    'create_datetime' => 'o_create_datetime',
    'flag' => 'o_flag'
);

$config['order/order_model/update_order'] = array(
        'owner' => 'o_owner',
        'checker' => 'o_checker',
        'checker_phone' => 'o_checker_phone',
        'payterms' => 'o_payterms',
        'payer' => 'o_payer',
        'payer_phone' => 'o_payer_phone',
        'logistics' => 'o_logistics',
        'out_method' => 'o_out_method',
        'delivery_area' => 'o_delivery_area',
        'delivery_address' => 'o_delivery_address',
        'delivery_linker' => 'o_delivery_linker',
        'delivery_phone' => 'o_delivery_phone',
        'remark' => 'o_remark',
        'dealer_remark' => 'o_dealer_remark',
        'sum' => 'o_sum',
        'sum_detail' => 'o_sum_detail',
		'sum_diff' => 'o_sum_diff',
        'asure_datetime' => 'o_asure_datetime',
        'request_outdate' => 'o_request_outdate',
        'payed_datetime' => 'o_payed_datetime',
        'end_datetime' => 'o_end_datetime',
        'stock_outted_id' => 'o_stock_outted_id',
        'flag' => 'o_flag',
        'cargo_no' => 'o_cargo_no'
);

$config['order/order_model/update_workflow'] = array(
    'status' => 'o_status',
    'dismantled_datetime' => 'o_dismantled_datetime',
    'checked_datetime' => 'o_checked_datetime',
    'quoted_datetime' => 'o_quoted_datetime',
    'asure_datetime' => 'o_asure_datetime', 
    'payed_datetime' => 'o_payed_datetime',
    'sum' => 'o_sum', 
    'sum_detail' => 'o_sum_detail', 
    'pack' => 'o_pack',
    'pack_detail' => 'o_pack_detail'
);

$config['order/order_model/update_batch'] = array(
    'oid' => 'o_id',
    'asure_datetime' => 'o_asure_datetime',
    'request_outdate' => 'o_request_outdate',
    'payed_datetime' => 'o_payed_datetime',
    'pack' => 'o_pack',
    'pack_detail' => 'o_pack_detail',
    'cargo_no' => 'o_cargo_no'
);

$config['order/order_product_model/insert_order_product'] = array(
		'oid' => 'op_order_id',
		'product' => 'op_product',
        'remark' => 'op_remark',
        'parent' => 'op_parent'
);
$config['order/order_product_model/update_batch'] = array(
        'opid' => 'op_id',
        'sum' => 'op_sum',
		'sum_diff' => 'op_sum_diff',
        'pack_detail' => 'op_pack_detail'
);

$config['order/order_product_model/update'] = array(
    	'product' => 'op_product',
        'remark' => 'op_remark',
        'parent' => 'op_parent',
        'bd' => 'op_bd',
        'dismantler' => 'op_dismantler',
        'pack' => 'op_pack',
        'pack_detail' => 'op_pack_detail',
        'packer' => 'op_packer',
        'pack_datetime' => 'op_pack_datetime'
);

$config['order/order_product_model/update_workflow'] = array(
    'dismantler' => 'op_dismantler',
    'dismantled_datetime' => 'op_dismantled_datetime',
    'print_datetime' => 'op_print_datetime',
    'status' => 'op_status',
	'scan_status' => 'op_scan_status',
	'scan_start' => 'op_scan_start',
	'scan_end'	=> 'op_scan_end'
);

$config['order/order_product_cabinet_struct_model/update'] = array(
    'bid' => 'opcs_board_id',
    'dgjg' => 'opcs_dgjg',
    'dghc' => 'opcs_dghc',
    'dgqc' => 'opcs_dgqc',
    'facefb' => 'opcs_facefb',
    'struct' => 'opcs_struct'
);

$config['order/order_product_cabinet_struct_model/insert'] = array(
    'opid' => 'opcs_order_product_id',
    'bid' => 'opcs_board_id',
    'dgjg' => 'opcs_dgjg',
    'dghc' => 'opcs_dghc',
    'dgqc' => 'opcs_dgqc',
    'facefb' => 'opcs_facefb',
    'struct' => 'opcs_struct'
);

$config['order/order_product_wardrobe_struct_model/update'] = array(
    'bid' => 'opws_board_id',
    'struct' => 'opws_struct'
);

$config['order/order_product_wardrobe_struct_model/insert'] = array(
    'opid' => 'opws_order_product_id',
    'bid' => 'opws_board_id',
    'struct' => 'opws_struct'
);

$config['order/order_product_door_model/update'] = array(
    'bid' => 'opd_board_id',
    'edge' => 'opd_edge'
);

$config['order/order_product_door_model/insert'] = array(
    'opid' => 'opd_order_product_id',
    'bid' => 'opd_board_id',
    'edge' => 'opd_edge'
);

$config['order/order_product_cabinet_model/insert_batch'] = array(
    'opcsid' => 'opc_order_product_cabinet_struct_id',
    'bb' => 'opc_beiban',
    'width' => 'opc_width',
    'depth' => 'opc_depth',
    'height' => 'opc_height',
    'name' => 'opc_cubicle_name',
    'no' => 'opc_cubicle_num',
    'num' => 'opc_amount',
    'yqjdepth' => 'opc_right_depth',
    'yqjwidth' => 'opc_right_width',
    'zqjdepth' => 'opc_left_depth',
    'zqjwidth' => 'opc_left_width',
    'ybl' => 'opc_ybilu',
    'zbl' => 'opc_zbilu',
    'diguiabnormity' => 'opc_diguiabnormity',
    'gbg' => 'opc_gebangu',
    'gbh' => 'opc_gebanhuo',
    'gbj' => 'opc_gebanjian',
    'size' => 'opc_size',
    'wbl' => 'opc_weibolu'
);

$config['order/order_product_board_model/insert'] = array(
		'opid' => 'opb_order_product_id',
		'board' => 'opb_board',
		'amount' => 'opb_amount',
		'area' => 'opb_area'
);

$config['order/order_product_board_model/update'] = array(
    'amount' => 'opb_amount',
    'area' => 'opb_area',
    'area_diff' => 'opb_area_diff',
    'unit_price' => 'opb_unit_price',
    'sum' => 'opb_sum',
    'sum_diff' => 'opb_sum_diff',
    'invisibility' => 'opb_invisibility',
    'invisibility_unit_price' => 'opb_invisibility_unit_price',
    'open_hole_unit_price' => 'opb_open_hole_unit_price',
    'open_hole' => 'opb_open_hole'
);

$config['order/order_product_board_model/update_batch'] = array(
	'opbid' => 'opb_id',
	'amount' => 'opb_amount',
	'area' => 'opb_area',
	'area_diff' => 'opb_area_diff',
    'unit_price' => 'opb_unit_price',
    'invisibility' => 'opb_invisibility',
    'open_hole' => 'opb_open_hole',
    'invisibility_unit_price' => 'opb_invisibility_unit_price',
    'open_hole_unit_price' => 'opb_open_hole_unit_price',
    'sum' => 'opb_sum',
    'sum_diff' => 'opb_sum_diff'
);

$config['order/order_product_classify_model/insert'] = array(
    'opid' => 'opc_order_product_id',
    'board' => 'opc_board',
    'classify_id' => 'opc_classify_id',
    'status' => 'opc_status',
    'optimize' => 'opc_optimize'
);

$config['order/order_product_classify_model/update'] = array(
    'amount' => 'opc_amount',
    'area' => 'opc_area',
    'optimize' => 'opc_optimize'
);

$config['order/order_product_classify_model/update_batch'] = array(
    'opcid' => 'opc_id',
    'amount' => 'opc_amount',
    'area' => 'opc_area',
    'optimize' => 'opc_optimize'
);

$config['order/order_product_classify_model/update_workflow'] = array(
    'status' => 'opc_status',
	'sn'	=> 'opc_sn',
	'optimizer'	=> 'opc_optimizer',
	'optimize_datetime'	=> 'opc_optimize_datetime'
);

$config['order/order_product_board_plate_model/insert'] = array(
		'opbid' => 'opbp_order_product_board_id',
		'cubicle_name' => 'opbp_cubicle_name',
		'cubicle_num' => 'opbp_cubicle_num',
		'plate_name' => 'opbp_plate_name',
        'plate_num' => 'opbp_plate_num',
		'width' => 'opbp_width',
		'length' => 'opbp_length',
		'thick' => 'opbp_thick',
		'area' => 'opbp_area',
		'slot' => 'opbp_slot',
		'punch' => 'opbp_punch',
		'edge' => 'opbp_edge',
		'remark' => 'opbp_remark',
		'decide_size' => 'opbp_decide_size',
		'abnormity' => 'opbp_abnormity',
		'bd_file' => 'opbp_bd_file', 
		'left_edge' => 'opbp_left_edge',
		'right_edge' => 'opbp_right_edge',
		'up_edge' => 'opbp_up_edge',
		'down_edge' => 'opbp_down_edge',
        'qrcode' => 'opbp_qrcode'
);

$config['order/order_product_board_plate_model/update'] = array(
    'opbid' => 'opbp_order_product_board_id',
    'cubicle_name' => 'opbp_cubicle_name',
    'cubicle_num' => 'opbp_cubicle_num',
    'plate_name' => 'opbp_plate_name',
    'plate_num' => 'opbp_plate_num',
    'width' => 'opbp_width',
    'length' => 'opbp_length',
    'thick' => 'opbp_thick',
    'area' => 'opbp_area',
    'slot' => 'opbp_slot',
    'punch' => 'opbp_punch',
    'edge' => 'opbp_edge',
    'remark' => 'opbp_remark',
	'decide_size' => 'opbp_decide_size',
    'abnormity' => 'opbp_abnormity',
    'bd_file' => 'opbp_bd_file',
    'left_edge' => 'opbp_left_edge',
    'right_edge' => 'opbp_right_edge',
    'up_edge' => 'opbp_up_edge',
    'down_edge' => 'opbp_down_edge',
    'qrcode' => 'opbp_qrcode'
);
$config['order/order_product_board_plate_model/insert_batch'] = array(
        'opbid' => 'opbp_order_product_board_id',
        'cubicle_name' => 'opbp_cubicle_name',
        'cubicle_num' => 'opbp_cubicle_num',
        'plate_name' => 'opbp_plate_name',
        'plate_num' => 'opbp_plate_num',
        'width' => 'opbp_width',
        'length' => 'opbp_length',
        'thick' => 'opbp_thick',
        'area' => 'opbp_area',
        'slot' => 'opbp_slot',
        'punch' => 'opbp_punch',
        'edge' => 'opbp_edge',
        'remark' => 'opbp_remark',
		'decide_size' => 'opbp_decide_size',
        'abnormity' => 'opbp_abnormity',
        'bd_file' => 'opbp_bd_file',
        'left_edge' => 'opbp_left_edge',
        'right_edge' => 'opbp_right_edge',
        'up_edge' => 'opbp_up_edge',
        'down_edge' => 'opbp_down_edge',
        'qrcode' => 'opbp_qrcode'
);

$config['order/order_product_board_plate_model/replace_order_product_board_plate'] = array(
        'opbid' => 'opbp_order_product_board_id',
        'cubicle_num' => 'opbp_cubicle_num',
        'cubicle_name' => 'opbp_cubicle_name',
        'plate_name' => 'opbp_plate_name',
        'plate_num' => 'opbp_plate_num',
        'length' => 'opbp_length',
        'width' => 'opbp_width',  //成型尺寸
        'thick' => 'opbp_thick',
        'area' => 'opbp_area',
        'slot' => 'opbp_slot',
        'punch' => 'opbp_punch',
        'edge' => 'opbp_edge',
        'remark' => 'opbp_remark',
		'decide_size' => 'opbp_decide_size',
        'abnormity' => 'opbp_abnormity',
        'left_edge' => 'opbp_left_edge',
        'right_edge' => 'opbp_right_edge',
        'up_edge' => 'opbp_up_edge',
        'down_edge' => 'opbp_down_edge',
        'qrcode' => 'opbp_qrcode',  /*二维码*/
        'bd_file' => 'opbp_bd_file'  /*BD文件*/
);

$config['order/order_product_board_door_model/insert_batch'] = array(
    'opbid' => 'opbd_order_product_board_id',
    'width' => 'opbd_width',
    'length' => 'opbd_length',
    'thick' => 'opbd_thick',
    'area' => 'opbd_area',
    'punch' => 'opbd_punch',
    'remark' => 'opbd_remark',
    'left_edge' => 'opbd_left_edge',
    'right_edge' => 'opbd_right_edge',
    'up_edge' => 'opbd_up_edge',
    'down_edge' => 'opbd_down_edge',
    'handle' => 'opbd_handle',
    'open_hole' => 'opbd_open_hole',
    'invisibility' => 'opbd_invisibility',
    'qrcode' => 'opbd_qrcode'
);

$config['order/order_product_board_wood_model/insert_batch'] = array(
    'opbid' => 'opbw_order_product_board_id',
    'wood_name' => 'opbw_wood_name',
    'wood_num' => 'opbw_wood_num',
    'width' => 'opbw_width',
    'length' => 'opbw_length',
    'thick' => 'opbw_thick',
    'area' => 'opbw_area',
    'punch' => 'opbw_punch',
    'core' => 'opbw_core',
	'center' => 'opbw_center',
    'remark' => 'opbw_remark'
);

$config['order/order_product_fitting_model/insert_batch'] = array(
    'opid' => 'opf_order_product_id',
    'fid' => 'opf_fitting_id',
    'name' => 'opf_fitting',
    'unit' => 'opf_unit',
    'unit_price' => 'opf_unit_price',
    'sum' => 'opf_sum',
    'amount' => 'opf_amount',
    'remark' => 'opf_remark'
);

$config['order/order_product_other_model/insert_batch'] = array(
    'opid' => 'opo_order_product_id',
    'oid' => 'opo_other_id',
    'name' => 'opo_other',
    'spec' => 'opo_spec',
    'unit' => 'opo_unit',
    'unit_price' => 'opo_unit_price',
    'sum' => 'opo_sum',
    'amount' => 'opo_amount',
    'remark' => 'opo_remark'
);

$config['order/order_product_server_model/insert_batch'] = array(
    'opid' => 'ops_order_product_id',
    'sid' => 'ops_server_id',
    'name' => 'ops_server',
    'unit' => 'ops_unit',
    'unit_price' => 'ops_unit_price',
    'sum' => 'ops_sum',
    'amount' => 'ops_amount',
    'remark' => 'ops_remark'
);

$config['order/order_product_board_plate_model/update_batch'] = array(
    'opbpid' => 'opbp_id',
    'opcid' => 'opbp_order_product_classify_id',
    'qrcode' => 'opbp_qrcode',
    'plate_num' => 'opbp_plate_num'
);

$config['order/order_product_fitting_model/update_batch'] = array(
    'opfid' => 'opf_id',
    'opid' => 'opf_order_product_id',
    'fid' => 'opf_fitting_id',
    'name' => 'opf_fitting',
    'unit' => 'opf_unit',
    'amount' => 'opf_amount',
    'unit_price' => 'opf_unit_price',
    'sum' => 'opf_sum'
);

$config['order/order_product_fitting_model/update_batch_order_product_fitting'] = array(
    'opfid' => 'opf_id',
    'opid' => 'opf_order_product_id',
    'fid' => 'opf_fitting_id',
    'name' => 'opf_fitting',
    'unit' => 'opf_unit',
    'amount' => 'opf_amount',
    'unit_price' => 'opf_unit_price',
    'sum' => 'opf_sum'
);

$config['order/order_product_other_model/update_batch'] = array(
    'opoid' => 'opo_id',
    'opid' => 'opo_order_product_id',
    'oid' => 'opo_other_id',
    'name' => 'opo_other',
    'spec' => 'opo_spec',
    'unit' => 'opo_unit',
    'amount' => 'opo_amount',
    'unit_price' => 'opo_unit_price',
    'sum' => 'opo_sum'
);

$config['order/order_product_other_model/update_batch_order_product_other'] = array(
    'opoid' => 'opo_id',
    'opid' => 'opo_order_product_id',
    'oid' => 'opo_other_id',
    'name' => 'opo_other',
    'spec' => 'opo_spec',
    'unit' => 'opo_unit',
    'amount' => 'opo_amount',
    'unit_price' => 'opo_unit_price',
    'sum' => 'opo_sum'
);

$config['order/order_product_server_model/update_batch'] = array(
    'opsid' => 'ops_id',
    'opid' => 'ops_order_product_id',
    'sid' => 'ops_server_id',
    'name' => 'ops_server',
    'unit' => 'ops_unit',
    'amount' => 'ops_amount',
    'unit_price' => 'ops_unit_price',
    'sum' => 'ops_sum'
);

$config['order/order_product_server_model/update_batch_order_product_server'] = array(
    'opsid' => 'ops_id',
    'opid' => 'ops_order_product_id',
    'sid' => 'ops_server_id',
    'name' => 'ops_server',
    'unit' => 'ops_unit',
    'amount' => 'ops_amount',
    'unit_price' => 'ops_unit_price',
    'sum' => 'ops_sum'
);

$config['order/order_model/update_status'] = array(
    'id' => 'o_id',
    'status' => 'o_status'
);
$config['order/order_product_model/update_status'] = array(
    'id' => 'op_id',
    'status' => 'op_status',
    'dismantler' => 'op_dismantler'
);
$config['order/order_product_board_model/update_status'] = array(
    'id' => 'opb_id',
    'status' => 'opb_status'
);

$config['order/order_product_model/insert_batch_order_product'] = array(
    'order_id' => 'op_order_id',
    'pid' => 'op_product_id',
    'num' => 'op_num',
    'dismantler' => 'op_dismantler'
);
