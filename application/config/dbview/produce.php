<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年11月6日
 * @author Zhangcc
 * @version
 * @des
 * 生产
 */
$config['produce/produce_abnormity/read'] = array(
		'opb_id' => 'opbid',
		'opb_board' => 'board',
		'o_num' => 'num',
		'o_remark' => 'remark',
		'status' => 'status',
		'o_dealer_name' => 'dealer',
		'o_dealer_linker' => 'dealer_linker',
		'o_dealer_address' => 'dealer_address',
		'o_dealer_phone' => 'dealer_phone',
		'o_owner' => 'owner',
		'o_request_outdate' => 'request_outdate',
		'u_truename' => 'creator',
		'create_datetime' => 'create_datetime'
);

$config['produce/produce_abnormity_detail/read'] = array(
		'opbp_id' => 'opbpid',
	    'opbp_qrcode' => 'qrcode',
	    'opbp_cubicle_name' => 'cubicle_name',
	    'opbp_cubicle_num' => 'cubicle_num',
	    'opbp_plate_name' => 'plate_name',
	    'opbp_plate_num' => 'plate_num',
	    'opbp_width' => 'width',
	    'opbp_length' => 'length',
	    'opbp_thick' => 'thick',
	    'opbp_slot' => 'slot',
	    'opbp_punch' => 'punch',
		'opbp_amount' => 'amount',
	    'opbp_edge' => 'edge',
	    'opbp_remark' => 'remark',
		'opbp_abnormity' => 'abnormity',
	    'opb_board' => 'board'
);

$config['produce/produce_bd_model/select_produce_bd'] = array(
        'op_id' => 'opid',
        'op_num' => 'order_product_num',
        'op_product' => 'product',
        'op_remark' => 'order_product_remark',
        'u_truename' => 'dismantler',
        'o_dealer' => 'dealer',
        'o_owner' => 'owner',
        'o_request_outdate' => 'request_outdate',
        'o_asure_datetime' => 'asure_datetime',
        'o_remark' => 'remark'
);

$config['produce/produce_optimize_model/select_produce_optimize'] = array(
    'opb_id' => 'opbid',
    'opb_board' => 'board',
    'opb_area' => 'area',
    'opb_amount' => 'amount',
    'opb_optimize' => 'status',
    'opb_optimize_datetime' => 'optimize_datetime',
    'A.u_truename' => 'optimizer',
    'op_num' => 'order_product_num',
    'op_remark' => 'order_product_remark',
    'o_remark' => 'remark',
    'o_dealer' => 'dealer',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'o_asure_datetime' => 'asure_datetime',
    'B.u_truename' => 'dismantler'
);

$config['produce/produce_optimize_model/select_produce_optimize_download'] = array(
    'opbp_id' => 'opbpid',
    'opbp_qrcode' => 'qrcode',
    'opbp_cubicle_name' => 'cubicle_name',
    'opbp_cubicle_num' => 'cubicle_num',
    'opbp_plate_name' => 'plate_name',
    'opbp_plate_num' => 'plate_num',
    'opbp_width' => 'width',
    'opbp_length' => 'length',
    'opbp_thick' => 'thick',
    'opbp_slot' => 'slot',
    'opbp_punch' => 'punch',
    'opbp_edge' => 'edge',
    'opbp_remark' => 'remark',
	'if(opbp_abnormity = 0, "", "异")' => 'abnormity',
    'opbp_up_edge' => 'up_edge',
    'opbp_down_edge' => 'down_edge',
    'opbp_left_edge' => 'left_edge',
    'opbp_right_edge' => 'right_edge',
    'opb_board' => 'board',
    'opb_optimize' => 'status',
    'op_num' => 'order_product_num',
    'o_dealer' => 'dealers',
    'o_owner' => 'owner'
);

$config['produce/produce_fitting/read'] = array(
    'op_id' => 'opid',
    'o_num' => 'num',
    'o_remark' => 'remark',
    'status' => 'status',
    'o_dealer_name' => 'dealer',
    'o_dealer_linker' => 'dealer_linker',
    'o_dealer_address' => 'dealer_address',
    'o_dealer_phone' => 'dealer_phone',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'clear_datetime' => 'clear_datetime',
    'u_truename' => 'clearer'
);

$config['produce/produce_other/read'] = array(
    'op_id' => 'opid',
    'o_num' => 'num',
    'o_remark' => 'remark',
    'status' => 'status',
    'o_dealer_name' => 'dealer',
    'o_dealer_linker' => 'dealer_linker',
    'o_dealer_address' => 'dealer_address',
    'o_dealer_phone' => 'dealer_phone',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'book_datetime' => 'book_datetime',
    'u_truename' => '"booker"'
);

$config['produce/produce_fitting_detail/read'] = array(
    'o_num' => 'order_num',
    'opf_id' => 'opfid',
    'opf_type' => 'type',
    'opf_name' => 'name',
    'opf_amount' => 'amount',
    'opf_unit' => 'unit',
    'opf_remark' => 'remark',
    'op_order_id' => 'oid'
);

$config['produce/produce_other_detail/read'] = array(
    'o_num' => 'order_num',
    'opo_id' => 'opoid',
    'opo_name' => 'name',
    'opo_length' => 'length',
    'opo_width' => 'width',
    'opo_amount' => 'amount',
    'opo_remark' => 'remark',
    'op_order_id' => 'oid'
);

$config['produce/produce_door/read'] = array(
    'opd_id' => 'opdid',
    'opd_board' => 'board',
    'opd_edge' => 'edge',
    'o_num' => 'num',
    'o_remark' => 'remark',
    'status' => 'status',
    'o_dealer_name' => 'dealer',
    'o_dealer_linker' => 'dealer_linker',
    'o_dealer_address' => 'dealer_address',
    'o_dealer_phone' => 'dealer_phone',
    'o_owner' => 'owner',
    'o_request_outdate' => 'request_outdate',
    'u_truename' => 'creator',
    'create_datetime' => 'create_datetime'
);

$config['produce/produce_door_detail/read'] = array(
    'opdp_id' => 'opdpid',
    'opdp_num' => 'num',
    'opdp_cubicle_name' => 'cubicle_name',
    'opdp_cubicle_num' => 'cubicle_num',
    'opdp_plate_name' => 'plate_name',
    'opdp_plate_num' => 'plate_num',
    'opdp_width' => 'width',
    'opdp_length' => 'length',
    'opdp_thick' => 'thick',
    'opdp_handle' => 'handle',
    'opdp_punch' => 'punch',
    'opdp_open_hole' => 'open_hole',
    'opdp_invisibility' => 'invisibility',
    'opdp_remark' => 'remark',
    'opdp_color' => 'color',
    'opdp_amount' => 'amount',
    'opdp_spec' => 'spec'
);

$config['produce/finished/read'] = array(
    'op_id' => 'opid',
    'o_id' => 'oid',
    'p_name' => 'product',
    'o_num' => 'num',
    'o_remark' => 'remark',
    'status_text' => 'status_text',
    'o_status' => 'status',
    'o_dealer_name' => 'dealer',
    'o_dealer_linker' => 'dealer_linker',
    'o_dealer_address' => 'dealer_address',
    'o_dealer_phone' => 'dealer_phone',
    'o_owner' => 'owner',
    'o_logistics' => 'logistics',
    'o_delivery_address' => 'delivery_address',
    'o_delivery_linker' => 'delivery_linker',
    'o_delivery_phone' => 'delivery_phone',
    'o_request_outdate' => 'request_outdate',
    'finisher' => 'finisher',
    'op_finished_datetime' => 'finished_datetime',
    'ender' => 'ender',
    'end_datetime' => 'end_datetime'
);
